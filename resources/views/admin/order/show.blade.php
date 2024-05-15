@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h3>Orders List</h3>
            </div>
            <div class="card-body">
                <div class="p-4 shadow bg-white">
                    <h4 class="mb-4">
                        <i class="fa fa-shopping-cart text-dark"></i> My Orders Detail
                        <a href="{{ url('/admin/orders') }}" class="btn btn-danger float-end btn-sm">Back</a>
                    </h4>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Detail</h5>
                            <hr>
                            <h6>Order ID: {{ $order->id }}</h6>
                            <h6>Tracking ID/No: {{ $order->tracking_no }}</h6>
                            <h6>Order Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                            <h6 class="border p-2 text-success">
                                Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Detail</h5>
                            <hr>
                            <h6>Full Name: {{ $order->full_name }}</h6>
                            <h6>Email: {{ $order->email }}</h6>
                            <h6>Phone: {{ $order->phone_number }}</h6>
                            <h6>Address: {{ $order->address }}</h6>
                            <h6>Pin Code: {{ $order->pincode }}</h6>
                        </div>
                    </div>
                    <br />
                    <h5>Order Items</h5><hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Item ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($order->order_items as $order_item)
                                    <tr>
                                        <td>{{ $order_item->id }}</td>
                                        <td>
                                            @if ($order_item->product->images)
                                            <img src="{{ asset($order_item->product->images[0]->image) }}" alt="" width="50" height="50">
                                            @else
                                            <img src="" alt="" width="50" height="50">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/collections/'. $order_item->product->category->slug .'/'. $order_item->product->slug) }}"> {{ $order_item->product->name }}</a>
                                           
                                            @if ($order_item->product_color?->color)
                                            <span> - Color: {{ $order_item->product_color?->color->name }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $order_item->price }}</td>
                                        <td>{{ $order_item->quantity }}</td>
                                        <td>{{ $order_item->price *  $order_item->quantity }}</td>
                                        @php
                                            $totalPrice += $order_item->price *  $order_item->quantity;
                                        @endphp
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Data</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="5" class="fw-bold">Total Amout</td>
                                    <td colspan="1" class="fw-bold">{{ $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection