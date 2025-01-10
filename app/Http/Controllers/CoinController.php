<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CoinController extends Controller
{
    /**
     * Menampilkan form top-up koin.
     */
    public function showTopUpForm()
    {
        $customerId = session('customer_id');
        $currentCoins = Customer::where('customer_id', $customerId)->value('coin');

        return view('topupView', compact('currentCoins'));
    }

    /**
     * Memproses top-up koin.
     */
    public function processTopUp(Request $request)
    {
        $customerId = session('customer_id');

        // Tambahkan 100 coin ke akun customer
        Customer::where('customer_id', $customerId)->increment('coin', 100);

        return redirect()->route('coins.topup')->with('success',  __('messages.topup_success'));
    }

}
