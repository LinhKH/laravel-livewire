@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h3>Products List
                        <a href="{{ route('products.create') }}" class="btn btn-danger btn-sm text-white float-end">Add Product</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
