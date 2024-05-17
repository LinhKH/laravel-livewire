@extends('layouts.app')
@section('title', 'My Orders Details')

@section('content')
<div class="py-3 pyt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if(session('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="p-4 shadow bg-white">
                    <h4 class="mb-4">
                        <i class="fa fa-shopping-cart text-dark"></i> My Orders Detail
                        <a href="{{ url('/my-orders') }}" class="btn btn-danger float-end btn-sm">Back</a>
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
                                Order Status Message: <span class="text-uppercase">{{ App\Enums\OrderStatus::from($order->status_message)->status() }}</span>
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
                    @php
                        $arrStatus = App\Enums\OrderStatus::cases();
                        // dd($arrStatus);
                        $stepStatus = array_search($order->status_message, array_column($arrStatus, 'value'));
                    @endphp
                    <div class="track">
                        @foreach ($arrStatus as $key => $trackStatus)
                            <div class="step {{ $key <= $stepStatus ? 'active' : '' }}"> <span class="icon"> <i class="fa {{ App\Enums\OrderStatus::from($trackStatus->value)->icon() }}"></i> </span> <span class="text text-uppercase">{{ App\Enums\OrderStatus::from($trackStatus->value)->status() }}</span> </div>
                        @endforeach
                    </div>
                    <h5 class="text-uppercase">Order Items</h5><hr>
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
                                            @if ($order_item->product->images->count() > 0 )
                                            <img src="{{ asset($order_item->product->images[0]->image) }}" alt="" width="50" height="50">
                                            @else
                                            <img src="{{ asset('assets/images/no-image.png') }}" alt="" width="50" height="50">
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