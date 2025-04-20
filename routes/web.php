<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageController;

Route::get('/', function() {
    return "Menampilkan daftar produk";
});

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/keranjang', function() {
    return "Produk ditambahkan ke keranjang";
});

Route::get('/checkout', function() {
    return "Checkout berhasil";
});

Route::get('/order', function() {
    return "Menampilkan riwayat pesanan";
});

Route::get('/profil', function() {
    return "Menampilkan profil pengguna";
});

Route::get('/helloworld', function() {
    return "ini adalah halaman web";
});

// Updated routes using HomepageController
Route::get('/', [HomepageController::class, 'index']);
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';