<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();

        $totalCustomers = User::where('role', 'customer')->count();

        $totalProducts = Product::count();

        $totalRevenue = Order::where('status', '!=', 'cancelled')
            ->sum('total');

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'totalRevenue',
            'recentOrders'
        ));
    }
}
