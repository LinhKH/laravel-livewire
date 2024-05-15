@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="py-3 pyt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if(session('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="p-4 shadow bg-white">
                    <h4 class="mb-4">My Orders</h4>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Order ID</th>
                                <th>Tracking No</th>
                                <th>User name</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->full_name }}</td>
                                        <td>{{ $order->payment_mode }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->status_message }}</td>
                                        <td>
                                            <a href="{{ url('/my-order/'. $order->id ) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Data</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                        {{ $orders->onEachSide(3)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection