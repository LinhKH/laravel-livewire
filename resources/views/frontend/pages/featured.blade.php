@extends('layouts.app')
@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Featured Products</h4>
                    <div class="underline mb-4"></div>
                </div>
                @forelse ($featuredProducts as $product)
                    
                <div class="col-6 col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            <label class="stock bg-danger">New</label>
                            @if ($product->images->count() > 0 && File::exists($product->images[0]->image))
                                <img src="{{ asset($product->images[0]->image) }}"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('assets/images/No_Image_Available.jpg') }}"
                                    alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $product->brand?->name }}</p>
                            <h5 class="product-name">
                                <a wire:navigate
                                    href="{{ url('collections/' . $product->category->slug . '/' . $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div>
                                <span class="selling-price">${{ $product->selling_price }}</span>
                                <span class="original-price">${{ $product->original_price }}</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">No Products available</div>
                @endforelse

                <div class="text-center">
                    <a href="{{ url('/collections') }}" class="btn btn-warning">View More</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
    0:{
    items:1
    },
    600:{
    items:3
    },
    1000:{
    items:5
    }
    }
    })
@endsection
