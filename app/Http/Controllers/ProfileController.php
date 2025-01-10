<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        if (!session()->has('is_logged_in') || !session('is_logged_in')) {
            return redirect()->route('login.form')->with('error', 'You must log in to access the profile page.');
        }

        $customer = Customer::where('customer_id', session('customer_id'))->first();

        $friends = Customer::join('friends', 'customers.customer_id', '=', 'friends.friend_id')
            ->where('friends.customer_id', $customer->customer_id)
            ->get(['customers.customer_id', 'customers.username', 'customers.photo']);

        return view('profileView', compact('customer', 'friends'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $storagePath = public_path('storage/profile_photos');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0775, true);
        }

        $customer = Customer::where('customer_id', session('customer_id'))->first();

        if (!$customer) {
            return redirect()->route('login.form')->with('error', 'User not found. Please log in again.');
        }

        if ($customer->photo && file_exists($storagePath . '/' . $customer->photo)) {
            unlink($storagePath . '/' . $customer->photo);
        }

        $photoName = time() . '.' . $request->photo->extension();
        $request->photo->move($storagePath, $photoName);

        $customer->update(['photo' => $photoName]);

        return redirect()->route('profile.show')->with('success', 'Profile photo updated successfully!');
    }

    public function removeFriend(Request $request)
{
    $request->validate([
        'friend_id' => 'required|exists:customers,customer_id',
    ]);

    $userId = session('customer_id');
    $friendId = $request->input('friend_id');

    // Hapus hubungan teman dua arah
    Friend::where('customer_id', $userId)
        ->where('friend_id', $friendId)
        ->delete();

    Friend::where('customer_id', $friendId)
        ->where('friend_id', $userId)
        ->delete();

    // Redirect kembali tanpa pesan
    return redirect()->route('profile.show');
}


    public function hideProfile(Request $request)
{
    $customerId = session('customer_id');
    $customer = Customer::find($customerId);

    // Validasi koin cukup
    if ($customer->coin < 50) {
        return back()->with('error', 'Not enough coins to hide your profile.');
    }

    // Hapus foto lama jika ada
    $storagePath = public_path('storage/profile_photos');
    if ($customer->photo && file_exists($storagePath . '/' . $customer->photo)) {
        unlink($storagePath . '/' . $customer->photo);
    }

    // Pilih foto random
    $hiddenPhotos = ['hidden_1.jpg', 'hidden_2.jpg', 'hidden_3.jpg'];
    $randomPhoto = $hiddenPhotos[array_rand($hiddenPhotos)];

    // Path asal dan penyimpanan
    $sourcePath = public_path('storage/hidden_profiles/' . $randomPhoto); // Path foto random

    // Simpan file acak dengan nama baru
    $photoName = time() . '.' . pathinfo($sourcePath, PATHINFO_EXTENSION); // Format nama file baru
    $newPhotoPath = $storagePath . '/' . $photoName;

    // Salin file foto random ke lokasi penyimpanan baru
    if (!file_exists($sourcePath) || !copy($sourcePath, $newPhotoPath)) {
        return back()->with('error', 'Failed to hide your profile.');
    }

    // Update status, kurangi koin, dan ganti foto
    $customer->update([
        'is_hidden' => true,
        'coin' => $customer->coin - 50,
        'photo' => $photoName, // Simpan nama file acak baru di database
    ]);

    return back()->with('success', 'Your profile is now hidden!');
}



public function unhideProfile(Request $request)
{
    $customerId = session('customer_id');
    $customer = Customer::find($customerId);

    // Validasi koin cukup
    if ($customer->coin < 5) {
        return back()->with('error', 'Not enough coins to unhide your profile.');
    }

    // Hapus foto lama jika ada
    $storagePath = public_path('storage/profile_photos');
    if ($customer->photo && file_exists($storagePath . '/' . $customer->photo)) {
        unlink($storagePath . '/' . $customer->photo);
    }

    // Path ke foto default
    $defaultSourcePath = public_path('images/default-profile.png'); // Pastikan foto default ada di folder ini

    // Simpan file default dengan nama baru
    $photoName = time() . '.png'; // Format nama file baru
    $newPhotoPath = $storagePath . '/' . $photoName;

    // Salin foto default ke lokasi penyimpanan baru
    if (!file_exists($defaultSourcePath) || !copy($defaultSourcePath, $newPhotoPath)) {
        return back()->with('error', 'Failed to set default profile photo.');
    }

    // Update status dan kurangi koin
    $customer->update([
        'is_hidden' => false,
        'coin' => $customer->coin - 5,
        'photo' => $photoName, // Simpan nama file default baru di database
    ]);

    return back()->with('success', 'Your profile is now visible!');
}






}
