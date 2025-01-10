<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Friend;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender');
        $hobby = $request->query('hobby');
        $userId = session('customer_id');
    
        // Ambil daftar teman untuk user yang sedang login
        $friends = Friend::where('customer_id', $userId)->pluck('friend_id')->toArray();
    
        // Ambil daftar wishlist untuk user yang sedang login
        $wishlisted = Wishlist::where('customer_id', $userId)->pluck('wishlist_customer_id')->toArray();
    
        // Query untuk mendapatkan customer berdasarkan filter
        $customers = Customer::whereNotNull('email')
            ->where('customer_id', '!=', $userId) // Kecualikan user yang sedang login
            ->whereNotIn('customer_id', $friends) // Kecualikan pelanggan yang sudah menjadi teman
            ->whereNotIn('customer_id', $wishlisted) // Kecualikan pelanggan yang ada di wishlist
            ->when($gender, function ($query) use ($gender) {
                if (in_array($gender, ['male', 'female'])) {
                    $query->where('gender', $gender);
                }
            })
            ->when($hobby, function ($query) use ($hobby) {
                $query->where('hobby', 'LIKE', '%' . $hobby . '%');
            })
            ->get();
    
        return view('homeView', compact('customers'));
    }
    

    public function showDetail($id)
    {
        if (!session()->has('is_logged_in') || !session('is_logged_in')) {
            return redirect()->route('login.form')->with('error', 'You must log in to view customer details.');
        }

        $customer = Customer::find($id);

        if (!$customer) {
            return redirect()->route('home')->with('error', 'Customer not found.');
        }

        return view('customerDetail', compact('customer'));
    }
}
