@extends('layouts.app')

@section('title')
{{ $category->meta_title }}
@endsection
@section('description')
{{ $category->meta_description }}
@endsection
@section('keywowrds')
{{ $category->meta_keyowrd }}
@endsection

@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>
            @forelse ($products as $key => $product)

            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
                        @if ($product->quantity > 0)
                        <label class="stock bg-success">In Stock</label>
                        @else
                        <label class="stock bg-danger">Out of Stock</label>
                        @endif
                        @if ($product->images->count() > 0)
                        <img src="{{ asset($product->images[0]->image) }}" alt="{{ $product->name }}">
                            
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $product->brand?->name }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('collections/'. $product->category->slug .'/'.$product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="" class="btn btn1">Add To Cart</a>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                            <a href="" class="btn btn1"> View </a>
                        </div>
                    </div>
                </div>
            </div>
                
            @empty
            <div class="col-md-12">
                <h4 class="p-2">No Products Available for {{ $category->name }}</h4>
            </div>
            @endforelse
            
        </div>
    </div>
</div>
@endsection