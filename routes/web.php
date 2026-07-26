<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Web Controllers
use App\Http\Controllers\Web\Profile\ProfileController;
use App\Http\Controllers\Web\Home\HomeController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\OrderInvoiceController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\Auth\PasswordResetController;
use App\Http\Controllers\Web\Favorites\FavoriteController;
use App\Http\Controllers\Web\Admin\AdminDashboardController;

// API Customer Controllers (used in web routes)
use App\Http\Controllers\Api\V1\Products\ProductController;
use App\Http\Controllers\Api\V1\Categories\CategoryController;
use App\Http\Controllers\Api\V1\Subcategories\SubcategoryController;
use App\Http\Controllers\Api\V1\AddOns\AddOnController;
use App\Http\Controllers\Api\V1\DeliveryZones\DeliveryZoneController;
use App\Http\Controllers\Api\V1\Orders\OrderController;
use App\Http\Controllers\Api\V1\Carts\CartController;
use App\Http\Controllers\Api\V1\Addresses\AddressController;
use App\Http\Controllers\Api\V1\Reviews\ReviewController;

// API Admin Controllers (used in web admin routes)
use App\Http\Controllers\Api\V1\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Api\V1\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Api\V1\Admin\AddOnController as AdminAddOnController;
use App\Http\Controllers\Api\V1\Admin\DeliveryZoneController as AdminDeliveryZoneController;

use App\Http\Controllers\Web\Admin\AdminStoreLocationController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {


    // Auth Actions
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('password', [AuthController::class, 'updatePassword'])->name('password.update');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart & Checkout
    Route::get('/cart', function (Request $request) {
        if ($request->expectsJson()) {
            return app(CartController::class)->show($request);
        }
        return view('front.cart');
    })->name('cart.index');

    Route::get('/checkout', function () {
        return view('front.checkout');
    })->name('checkout.index');

    // Favorites
    Route::post('/favorites/toggle/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    /*
    |--------------------------------------------------------------------------
    | Protected Customer API Endpoints
    |--------------------------------------------------------------------------
    */
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/orders/{id}/invoice', [OrderInvoiceController::class, 'show'])->name('orders.invoice');
    Route::get('/orders/{id}/invoice/download', [OrderInvoiceController::class, 'download'])->name('orders.invoice.download');

    Route::get('/api/cart', [CartController::class, 'show']);
    Route::post('/cart/items', [CartController::class, 'add']);
    Route::put('/cart/items/{id}', [CartController::class, 'update']);
    Route::delete('/cart/items/{id}', [CartController::class, 'remove']);

    Route::post('/api/v1/products/{product}/reviews', [ReviewController::class, 'store']);

    Route::apiResource('addresses', AddressController::class);
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard & Management Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->as('web.admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'update']);

    Route::apiResource('products', AdminProductController::class);
    Route::apiResource('categories', AdminCategoryController::class);
    Route::apiResource('subcategories', AdminSubcategoryController::class);
    Route::apiResource('add-ons', AdminAddOnController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('delivery-zones', AdminDeliveryZoneController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('store-locations', AdminStoreLocationController::class);
});

/*
|--------------------------------------------------------------------------
| Public Customer API Endpoints
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/subcategories', [SubcategoryController::class, 'index']);
Route::get('/add-ons', [AddOnController::class, 'index']);
Route::get('/delivery-zones', [DeliveryZoneController::class, 'index']);
