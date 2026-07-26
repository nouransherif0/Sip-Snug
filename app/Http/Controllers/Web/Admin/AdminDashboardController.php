<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\AddOn;
use App\Models\DeliveryZone;
use App\Models\Order;
<<<<<<< HEAD
=======
use App\Models\StoreLocation;
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64

class AdminDashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $categories = Category::withCount('subcategories')->latest()->get();
        $subcategories = Subcategory::with('category')->withCount('products')->latest()->get();
        $products = Product::with('subcategory.category')->latest()->get();
        $addOns = AddOn::latest()->get();
        $deliveryZones = DeliveryZone::latest()->get();
        $orders = Order::with(['user', 'address'])->latest()->get();
=======
        $categories = Category::withCount('subcategories')->orderBy('id', 'asc')->get();
        $subcategories = Subcategory::with('category')->withCount('products')->orderBy('id', 'asc')->get();
        $products = Product::with('subcategory.category')->orderBy('id', 'asc')->get();
        $addOns = AddOn::with(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products'])->orderBy('id', 'asc')->get();
        $deliveryZones = DeliveryZone::latest()->get();
        $orders = Order::with(['user', 'address'])->latest()->get();
        $storeLocations = StoreLocation::orderBy('id', 'asc')->get();
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64

        // Analytics
        $totalSales = $orders->where('status', 'delivered')->sum('total_price');
        $activeOrdersCount = $orders->whereIn('status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])->count();
        $bestSellingProducts = Product::where('is_featured', true)->take(6)->get();
        $highRatedProducts = Product::with('subcategory')->latest()->take(6)->get();
        $lowStockCount = $products->where('stock', '<=', 10)->count();
        $lowStockProducts = $products->where('stock', '<=', 10);

        return view('admin.dashboard', compact(
            'categories',
            'subcategories',
            'products',
            'addOns',
            'deliveryZones',
            'orders',
<<<<<<< HEAD
=======
            'storeLocations',
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
            'totalSales',
            'activeOrdersCount',
            'bestSellingProducts',
            'highRatedProducts',
            'lowStockCount',
            'lowStockProducts'
        ));
    }
}
