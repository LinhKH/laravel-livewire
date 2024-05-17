<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->filter_date != null, function ($query) use ($request) { 
            return $query->whereDate('created_at', $request->filter_date);
        }, function ($query) use ($todayDate) {
            return $query->whereDate('created_at', $todayDate);
        })->when($request->filter_status != null, function ($query) use ($request) {
            return $query->where('status_message', $request->filter_status);
        })->when($request->filter_payment_mode != null, function ($query) use ($request) {
            return $query->where('payment_mode', $request->filter_payment_mode);
        })
        ->orderBy('created_at', 'DESC')->paginate(10)->withQueryString();
        // dd($orders);
        return view('admin.order.index', compact('orders'));
    }

    function show($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.order.show', compact('order'));
    }
    function updateOrderStatus($order_id)
    {
        $order = Order::findOrFail($order_id);

        $order->update([
            'status_message' => request('status_message')
        ]);

        return redirect()->back()->with('message', 'Order Status Updated Successfully');

    }
}
