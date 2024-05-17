<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $totalUsers = User::all()->count();
        $totalProducts = Product::all()->count();

        $totalOrder = Order::all()->count();
        $todayOrder = Order::whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
        $thisMonthOrder = Order::whereMonth('created_at', Carbon::now()->format('m'))->count();
        $thisYearOrder = Order::whereYear('created_at', Carbon::now()->format('Y'))->count();

        return view('admin.dashboard',compact('totalOrder', 'todayOrder', 'thisMonthOrder', 'thisYearOrder', 'totalProducts',
            'totalUsers'
            ));
    }
}
