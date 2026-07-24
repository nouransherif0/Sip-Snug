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

class AdminDashboardController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('subcategories')->latest()->get();
        $subcategories = Subcategory::with('category')->withCount('products')->latest()->get();
        $products = Product::with('subcategory.category')->latest()->get();
        $addOns = AddOn::latest()->get();
        $deliveryZones = DeliveryZone::latest()->get();
        $orders = Order::with(['user', 'address'])->latest()->get();

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
            'totalSales',
            'activeOrdersCount',
            'bestSellingProducts',
            'highRatedProducts',
            'lowStockCount',
            'lowStockProducts'
        ));
    }
}
