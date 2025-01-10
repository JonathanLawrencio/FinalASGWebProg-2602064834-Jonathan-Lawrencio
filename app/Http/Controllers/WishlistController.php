<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Customer;
use App\Models\Friend;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (!session()->has('is_logged_in') || !session('is_logged_in')) {
            return redirect()->route('login.form')->with('error', 'You must log in to add to wishlist.');
        }

        $userId = session('customer_id');
        $targetCustomerId = $request->input('wishlist_customer_id');

        if (!$targetCustomerId) {
            return back()->with('error', 'Invalid target customer.');
        }

        // Cek apakah sudah ada di wishlist
        $existingWishlist = Wishlist::where('customer_id', $userId)
            ->where('wishlist_customer_id', $targetCustomerId)
            ->first();

        if ($existingWishlist) {
            return back()->with('error', 'Customer is already in your wishlist.');
        }

        // Tambahkan ke wishlist
        Wishlist::create([
            'customer_id' => $userId,
            'wishlist_customer_id' => $targetCustomerId,
        ]);

        // Kirim notifikasi ke customer target
        Notification::create([
            'customer_id' => $targetCustomerId, // ID customer penerima notifikasi
            'sender_id' => $userId, // ID customer pengirim notifikasi
            'message' => 'You have received a friend request!',
        ]);

        // Cek apakah mutual thumbs up terjadi
        $isMutual = Wishlist::where('customer_id', $targetCustomerId)
            ->where('wishlist_customer_id', $userId)
            ->exists();

        if ($isMutual) {
            // Tambahkan ke friendlist masing-masing
            Friend::firstOrCreate([
                'customer_id' => $userId,
                'friend_id' => $targetCustomerId,
            ]);

            Friend::firstOrCreate([
                'customer_id' => $targetCustomerId,
                'friend_id' => $userId,
            ]);

            // Hapus dari wishlist masing-masing
            Wishlist::where('customer_id', $userId)
                ->where('wishlist_customer_id', $targetCustomerId)
                ->delete();

            Wishlist::where('customer_id', $targetCustomerId)
                ->where('wishlist_customer_id', $userId)
                ->delete();
        }

        return back()->with('success', 'Friend request sent successfully.');
    }


    public function index()
    {
        $loggedInCustomerId = session('customer_id');

        // Get all friend IDs
        $friendIds = Friend::where('customer_id', $loggedInCustomerId)
            ->orWhere('friend_id', $loggedInCustomerId)
            ->pluck('friend_id', 'customer_id')
            ->merge(Friend::where('friend_id', $loggedInCustomerId)->pluck('customer_id', 'friend_id'));

        // Get customers in wishlist except those who are friends
        $wishlists = Customer::join('wishlists', 'customers.customer_id', '=', 'wishlists.wishlist_customer_id')
            ->where('wishlists.customer_id', $loggedInCustomerId)
            ->whereNotIn('customers.customer_id', $friendIds)
            ->select('customers.*')
            ->get();

        return view('wishlistView', compact('wishlists'));
    }

    public function remove(Request $request)
    {
        $request->validate([
            'wishlist_customer_id' => 'required|exists:customers,customer_id',
        ]);

        Wishlist::where('customer_id', session('customer_id'))
            ->where('wishlist_customer_id', $request->wishlist_customer_id)
            ->delete();

        return redirect()->route('wishlist.index')->with('success',  __('messages.customer_removed'));
    }
}
