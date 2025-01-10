<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  
    public function showLoginForm()
    {
        return view('loginView');
    }

   
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username
        $customer = Customer::where('username', $request->input('username'))->first();

        // Periksa apakah user ditemukan dan password cocok
        if ($customer && $customer->password === $request->input('password')) {
            // Simpan informasi user di session
            session(['is_logged_in' => true]);
            session(['customer_id' => $customer->customer_id]);
            session(['username' => $customer->username]);

            return redirect()->route('home')->with('success', __('messages.validation.login_successful'));
        }

        // Jika username atau password salah
        return back()->withErrors(['credentials' => __('messages.validation.invalid_credentials')]);
    }


   
    public function logout()
    {
        // Hapus semua data session
        session()->flush();

        // Redirect ke halaman login
        return redirect()->route('login.form')->with('success', 'You have been logged out.');
    }
}
