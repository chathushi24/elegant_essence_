<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\OrderController;

// ✅ Jetstream Authentication for Users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $recentProducts = \App\Models\Product::orderBy('created_at', 'desc')->limit(6)->get();
        return view('welcome', compact('recentProducts'));
    })->name('dashboard');
});

// ✅ Homepage Route (For Unauthenticated Users)
Route::get('/', function () {
    $recentProducts = \App\Models\Product::orderBy('created_at', 'desc')->limit(6)->get();
    return view('welcome', compact('recentProducts'));
})->name('home');


// ✅ Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// ✅ Admin Panel (Ensure Product Routes Exist)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // ✅ Define Correct Route Name for Product Management
    Route::resource('/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
});


// Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update'); // ✅ Ensure this points to `update()`
    Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});