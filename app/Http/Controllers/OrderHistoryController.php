<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('medicine')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('patient.orders.index', compact('orders'));
    }
}