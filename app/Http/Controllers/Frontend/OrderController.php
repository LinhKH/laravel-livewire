<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.order.index', compact('orders'));
    }

    function show($order_id) 
    {
        $order = Order::findOrFail($order_id);
        return view('frontend.order.show', compact('order'));
    }
}
