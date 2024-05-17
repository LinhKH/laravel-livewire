@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h3>Orders List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ url('admin/orders') }}" method="GET">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="">Filter by date</label>
                                <input type="date" name="filter_date" value="{{ Request::get('filter_date') ?? date('Y-m-d') }}" class="form-control" style="height: 39px">
                            </div>
                            <div class="col-sm">
                                <label for="">Filter by status</label>
                                <select name="filter_status" id="" class="form-control">
                                    <option value="">All</option>
                                    <option value="in progress" {{ Request::get('filter_status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ Request::get('filter_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" {{ Request::get('filter_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="cancelled" {{ Request::get('filter_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="out-for-delivery" {{ Request::get('filter_status') == 'out-for-delivery' ? 'selected' : '' }}>Out for delivery</option>
                                </select>
        
                            </div>
                            <div class="col-sm">
                                <label for="">Filter by Payment</label>
                                <select name="filter_payment_mode" id="" class="form-control">
                                    <option value="">All</option>
                                    <option value="Paid By Paypal" {{ Request::get('filter_payment_mode') == 'Paid By Paypal' ? 'selected' : '' }}>Paid By Paypal</option>
                                    <option value="Cash on Delivery" {{ Request::get('filter_payment_mode') == 'Cash on Delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                                </select>
        
                            </div>
                            <div class="col-sm">
                                <br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
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
                                    <a href="{{ url('/admin/order/'. $order->id ) }}"
                                        class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Data</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $orders->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection