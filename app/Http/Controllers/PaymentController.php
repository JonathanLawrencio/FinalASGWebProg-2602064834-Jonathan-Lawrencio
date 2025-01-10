<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;

class PaymentController extends Controller
{
    /**
     * Menampilkan form pembayaran.
     */
    public function showPaymentForm()
    {
        $price = Session::get('price');
        $userData = Session::get('user_data');

        // Pastikan data registrasi ada di session
        if (!$price || !$userData) {
            return redirect()->route('register.create')->with('error', 'Please complete registration first.');
        }

        $overpaidAmount = Session::get('overpaid_amount', 0); // Ambil overpaid jika ada
        return view('form', compact('price', 'overpaidAmount'));
    }

    /**
     * Memproses pembayaran.
     */
    public function processPayment(Request $request)
    {
        // Validasi input pembayaran
        $request->validate([
            'paid_amount' => 'required|numeric|min:0',
            'decision' => 'nullable|string|in:yes,no', // Hanya valid jika ada overpaid
        ]);

        $price = Session::get('price');
        $paidAmount = $request->input('paid_amount');
        $decision = $request->input('decision'); // Keputusan untuk overpaid

        // Kasus underpaid
        if ($paidAmount < $price) {
            $underpaid = $price - $paidAmount;
            return back()->with('error', "You are still underpaid by $underpaid.");
        }

        // Kasus overpaid
        if ($paidAmount > $price) {
            $overpaid = $paidAmount - $price;

            // Jika user sudah membuat keputusan untuk overpaid
            if ($decision) {
                if ($decision === 'yes') {
                    // Masukkan saldo ke wallet
                    return $this->completeRegistration($price, $overpaid);
                } else {
                    // Minta user untuk mengulang pembayaran
                    return back()->with('error', 'Please re-enter your payment amount.');
                }
            }

            // Simpan overpaid ke session dan tampilkan opsi
            Session::put('overpaid_amount', $overpaid);
            return back()->with('overpaid', "You overpaid by $overpaid");
        }

        // Kasus pembayaran tepat
        return $this->completeRegistration($price, 0); // Tidak ada saldo wallet
    }

    /**
     * Menyelesaikan proses registrasi.
     */
    private function completeRegistration($price, $walletBalance)
    {
        $userData = Session::get('user_data');

        // Cek apakah customer sudah ada di database berdasarkan email
        $existingCustomer = Customer::where('email', $userData['email'])->first();

        if ($existingCustomer) {
            // Tambahkan koin ke saldo koin yang sudah ada
            $existingCustomer->update([
                'coin' => $existingCustomer->coin + $walletBalance,
            ]);
        } else {
            // Hitung total koin: koin default (100) + pembayaran lebih (walletBalance)
            $totalCoins = 100 + $walletBalance;

            // Simpan data user baru ke database
            Customer::create([
                'username' => $userData['username'],
                'password' => $userData['password'], // Simpan password langsung
                'email' => $userData['email'],
                'gender' => $userData['gender'],
                'hobby' => implode(',', $userData['hobby']),
                'instagram' => $userData['instagram'],
                'phone' => $userData['phone'],
                'price' => $price,
                'coin' => $totalCoins, // Koin default + pembayaran lebih
            ]);
        }

        // Hapus session setelah selesai
        Session::forget(['user_data', 'price', 'overpaid_amount']);

        // Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login.form')->with('success', 'Payment successful! Please log in.');
    }
}
