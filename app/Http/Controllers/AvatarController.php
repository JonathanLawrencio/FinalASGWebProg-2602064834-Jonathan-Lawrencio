<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Customer;
use App\Models\CustomerAvatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
   
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'store');
        $customerId = session('customer_id');

        $customer = Customer::find($customerId); // Mendapatkan data customer berdasarkan session

        // Avatar yang telah dibeli
        $purchasedAvatars = Avatar::whereHas('customers', function ($query) use ($customerId) {
            $query->where('customers.customer_id', $customerId);
        })->get();

        // Avatar yang tersedia untuk dibeli
        $availableAvatars = Avatar::whereDoesntHave('customers', function ($query) use ($customerId) {
            $query->where('customers.customer_id', $customerId);
        })->get();

        return view('avatarView', compact('availableAvatars', 'purchasedAvatars', 'tab', 'customer'));
    }


    public function purchase(Request $request)
    {
        $customerId = session('customer_id');
        $avatar = Avatar::find($request->avatar_id);

        if (!$avatar) {
            return back()->with('error', 'Avatar not found.');
        }

        $customer = Customer::find($customerId);

        // Validasi apakah koin cukup
        if ($customer->coin < $avatar->price) {
            return back()->with('error', 'Not enough coins to purchase this avatar.');
        }

        // Kurangi koin dan tambahkan avatar ke koleksi
        $customer->update(['coin' => $customer->coin - $avatar->price]);
        CustomerAvatar::create([
            'customer_id' => $customerId,
            'avatar_id' => $avatar->avatar_id,
        ]);

        return back()->with('success', __('messages.avatar_purchased_successfully'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|integer|min:0',
        ]);

        $storagePath = public_path('storage/avatars');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0775, true);
        }

        // Simpan file dengan nama unik
        $photoName = time() . '.' . $request->image->extension();
        $request->image->move($storagePath, $photoName);

      
        Avatar::create([
            'name' => $request->name,
            'image_path' => 'avatars/' . $photoName,
            'price' => $request->price,
        ]);

        return back()->with('success', 'New avatar uploaded successfully!');
    }

   
    public function equip(Request $request)
    {
        $customerId = session('customer_id');
        $avatarId = $request->avatar_id;

        // Periksa apakah profil dalam kondisi "hide"
        $customer = Customer::find($customerId);
        if ($customer->is_hidden) {
            return back()->with('error', 'You cannot equip an avatar while your profile is hidden.');
        }

        // Validasi apakah avatar dimiliki oleh customer
        $ownedAvatar = CustomerAvatar::where('customer_id', $customerId)
            ->where('avatar_id', $avatarId)
            ->exists();

        if (!$ownedAvatar) {
            return back()->with('error', 'You do not own this avatar.');
        }

        // Update foto profil customer dengan avatar yang dipilih
        $avatar = Avatar::find($avatarId);
        $storagePath = public_path('storage/profile_photos');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0775, true);
        }

        // Hapus foto profil lama jika ada
        if ($customer->photo) {
            $oldPhotoPath = $storagePath . '/' . $customer->photo;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Salin file avatar ke folder penyimpanan foto profil
        $originalAvatarPath = public_path($avatar->image_path);
        if (!file_exists($originalAvatarPath)) {
            return back()->with('error', 'Avatar file does not exist.');
        }

        $photoName = time() . '.' . pathinfo($originalAvatarPath, PATHINFO_EXTENSION);
        $newPhotoPath = $storagePath . '/' . $photoName;

        if (!copy($originalAvatarPath, $newPhotoPath)) {
            return back()->with('error', 'Failed to equip avatar as profile picture.');
        }

        $customer->update(['photo' => $photoName]);

        return back()->with('success',  __('messages.avatar_equipped'));
    }





}
