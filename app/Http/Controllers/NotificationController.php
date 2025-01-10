<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
{
    $customerId = session('customer_id');

    // Ambil semua notifikasi untuk customer yang sedang login
    $notifications = Notification::where('customer_id', $customerId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('notificationView', compact('notifications'));
}

}
