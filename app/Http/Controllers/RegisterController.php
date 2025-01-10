<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function create()
    {
        // Generate harga registrasi random
        $price = rand(100000, 125000);
        return view('registerView', compact('price'));
    }

    /**
     * Menyimpan data registrasi ke session dan mengarahkan ke halaman payment.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:customers,username',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:customers,email',
            'gender' => 'required|in:male,female',
            'hobby' => 'required|array|min:3', // Minimal 3 hobi
            'hobby.*' => 'string|max:255', // Validasi setiap elemen array hobby
            'instagram' => 'required|string|regex:/^http:\\/\\/www\\.instagram\\.com\\/[a-zA-Z0-9._-]+$/',
            'phone' => 'required|numeric|min:10', // Phone harus numerik
        ]);

        // Harga registrasi (price) yang dikirim dari form
        $price = $request->input('price');

        // Simpan data sementara ke session
        Session::put('user_data', $validatedData);
        Session::put('price', $price);

        // Arahkan user ke halaman payment
        return redirect()->route('payment.form')->with('success', 'Registration data saved. Please proceed to payment.');
    }

}
