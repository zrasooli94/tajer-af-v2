<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_users' => User::count(),
            'total_categories' => Category::count(),
            'revenue' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock' => Product::where('stock', '<', 5)->count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = Product::where('stock', '<', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts'));
    }
}