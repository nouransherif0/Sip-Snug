<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Orders\OrderController;
use App\Http\Controllers\Api\V1\SavedCards\SavedCardController;
use App\Http\Controllers\Api\V1\Chats\ChatController;
use App\Http\Controllers\Api\V1\Rewards\RewardController;
use App\Http\Controllers\Api\V1\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Api\V1\Carts\CartController;
use App\Http\Controllers\Api\V1\Addresses\AddressController;
use App\Http\Controllers\Api\V1\Categories\CategoryController;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Subcategories\SubcategoryController;
use App\Http\Controllers\Api\V1\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Api\V1\Products\ProductController;
use App\Http\Controllers\Api\V1\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\V1\AddOns\AddOnController;
use App\Http\Controllers\Api\V1\Admin\AddOnController as AdminAddOnController;
use App\Http\Controllers\Api\V1\DeliveryZones\DeliveryZoneController;
use App\Http\Controllers\Api\V1\Admin\DeliveryZoneController as AdminDeliveryZoneController;
use App\Http\Controllers\Api\V1\Reviews\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->as('api.v1.')->group(function () {
    // Public Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/{product}/reviews', [ReviewController::class, 'index']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::get('/subcategories', [SubcategoryController::class, 'index']);

    Route::get('/add-ons', [AddOnController::class, 'index']);
    Route::get('/delivery-zones', [DeliveryZoneController::class, 'index']);
    Route::post('/chat', [ChatController::class, 'respond']);

    // Protected User Routes (Require Authentication)
    Route::middleware('auth:sanctum,web')->group(function () {
        // Reviews
        Route::post('/products/{product}/reviews', [ReviewController::class, 'store']);
        // Orders
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::post('/orders/{id}/reorder', [OrderController::class, 'reorder']);

        // Rewards
        Route::get('/rewards/points', [RewardController::class, 'getPoints']);
        Route::post('/rewards/redeem', [RewardController::class, 'redeem']);

        // Saved Cards
        Route::get('/saved-cards', [SavedCardController::class, 'index']);
        Route::post('/saved-cards', [SavedCardController::class, 'store']);

        // Carts
        Route::get('/cart', [CartController::class, 'show']);
        Route::post('/cart/items', [CartController::class, 'add']);
        Route::put('/cart/items/{id}', [CartController::class, 'update']);
        Route::delete('/cart/items/{id}', [CartController::class, 'remove']);

        // Addresses
        Route::apiResource('addresses', AddressController::class);
    });

    // Admin Routes
    Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->as('api.v1.admin.')->group(function () {
        Route::get('/orders', [AdminOrderController::class, 'index']);
        Route::put('/orders/{id}/status', [AdminOrderController::class, 'update']);

        Route::apiResource('products', AdminProductController::class);
        Route::apiResource('categories', AdminCategoryController::class);
        Route::apiResource('subcategories', AdminSubcategoryController::class);
        Route::apiResource('add-ons', AdminAddOnController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::apiResource('delivery-zones', AdminDeliveryZoneController::class)->only(['index', 'store', 'update', 'destroy']);
    });
});

// Admin fallback routes without v1 prefix for test compatibility
Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->as('api.admin.')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'update']);

    Route::apiResource('products', AdminProductController::class);
    Route::apiResource('categories', AdminCategoryController::class);
    Route::apiResource('subcategories', AdminSubcategoryController::class);
    Route::apiResource('add-ons', AdminAddOnController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('delivery-zones', AdminDeliveryZoneController::class)->only(['index', 'store', 'update', 'destroy']);
});

