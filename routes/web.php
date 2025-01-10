<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Session;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');


// Route untuk menampilkan halaman registrasi
// Route::get('/register', function () {
//     return view('registerView');  // Pastikan Anda memiliki view 'register' yang sudah dibuat
// });

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Route::get('/home', function () {
//     return view('homeView');  // Pastikan Anda memiliki view 'register' yang sudah dibuat
// })->name('home');


Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/customer/{id}', [HomeController::class, 'showDetail'])->name('customer.detail');

Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::post('/friend/remove', [ProfileController::class, 'removeFriend'])->name('friend.remove');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('/coins/topup', [CoinController::class, 'showTopUpForm'])->name('coins.topup');
Route::post('/coins/topup', [CoinController::class, 'processTopUp'])->name('coins.topup.process');

Route::get('/avatars', [AvatarController::class, 'index'])->name('avatars.index');
Route::post('/avatars/purchase', [AvatarController::class, 'purchase'])->name('avatars.purchase');
Route::post('/avatars/equip', [AvatarController::class, 'equip'])->name('avatars.equip');

Route::post('/profile/hide', [ProfileController::class, 'hideProfile'])->name('profile.hide');
Route::post('/profile/unhide', [ProfileController::class, 'unhideProfile'])->name('profile.unhide');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('change.language');
