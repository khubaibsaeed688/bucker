<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Current user ke orders
        $orders = Order::with('items')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        // Latest order for billing/shipping address
        $latestOrder = Order::where('user_id', $user->id)
            ->latest()
            ->first();

        return view('frontend.account.dashboard', compact(
            'user',
            'orders',
            'latestOrder'
        ));
    }


    public function showOrder($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.account.order-details', compact('order'));
    }
}
