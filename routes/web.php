<?php 
 
use Livewire\Volt\Volt; 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\HomePageController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ProductController; 
 
 
 
//kode baru diubah menjadi seperti ini 
Route::get('/', [HomePageController::class, 'index'])->name('home'); 
Route::get('products', [HomePageController::class, 'products']); 
Route::get('product/{slug}', [HomePageController::class, 'product']); 
Route::get('categories',[HomePageController::class, 'categories']); 
Route::get('category/{slug}', [HomePageController::class, 'category']); 
Route::get('cart', [HomePageController::class, 'cart']); 
Route::get('checkout', [HomePageController::class, 'checkout']); 
 
 
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
   Route::resource('categories',ProductController::class); 
 
})->middleware(['auth', 'verified']); 
 
 
Route::middleware(['auth'])->group(function () { 
   Route::redirect('settings', 'settings/profile'); 
 
   Volt::route('settings/profile', 
'settings.profile')->name('settings.profile'); 
   Volt::route('settings/password', 
'settings.password')->name('settings.password'); 
   Volt::route('settings/appearance', 
'settings.appearance')->name('settings.appearance'); 
}); 
 
require __DIR__.'/auth.php'; 