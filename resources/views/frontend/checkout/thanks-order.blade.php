@extends('layouts.app')
@section('title', 'Thank you to shopping')

@section('content')
<div class="py-3 pyt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if(session('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="p-4 shadow bg-white">
                    <h2>Logo here</h2>
                    <h4>Thank you for shopping</h4>
                    <a href="{{ url('/collections') }}" class="btn btn-warning w-100">Continue shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection