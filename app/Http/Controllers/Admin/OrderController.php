<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->filter_date != null, function ($query) use ($request) { 
            return $query->whereDate('created_at', $request->filter_date);
        }, function ($query) use ($todayDate) {
            // return $query->whereDate('created_at', $todayDate);
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
        if (request('status_message') == 4) {

            foreach ($order->order_items as $orderItem) {
                if ($orderItem->product_color_id !== null) {
                    $orderItem->product_color->where('id', $orderItem->product_color_id)->update([
                        'quantity' => $orderItem->product_color->quantity + (int)$orderItem->quantity,
                    ]);
                } else {
                    $orderItem->product->where('id', $orderItem->product_id)->update([
                        'quantity' => $orderItem->product->quantity + (int)$orderItem->quantity,
                    ]);
                }
            }
        }
        $order->update([
            'status_message' => request('status_message')
        ]);

        return redirect()->back()->with('message', 'Order Status Updated Successfully');

    }

    function viewInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.order.invoice', compact('order'));
    }
    function generateInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        $pdf = Pdf::loadView('admin.order.invoice', ['order' => $order]);

        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->download('invoice'.$order->id.'-'. $todayDate.'.pdf');
    }
}
