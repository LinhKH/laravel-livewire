@extends('layouts.app')
@section('sliders')
    @include('layouts.inc.frontend.slider')
@endsection
@section('content')

    <div class="bg-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h4 class="text-uppercase">Welcome to Linh Kieu's Shop Ecommerce</h4>
                    <div class="underline"></div>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error et, necessitatibus placeat voluptas
                        mollitia deleniti delectus porro,
                        quisquam animi ut id voluptatibus quis officia cupiditate a dolorum perspiciatis. Vero, doloremque.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error et, necessitatibus placeat voluptas
                        mollitia deleniti delectus porro,
                        quisquam animi ut id voluptatibus quis officia cupiditate a dolorum perspiciatis. Vero, doloremque.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error et, necessitatibus placeat voluptas
                        mollitia deleniti delectus porro,
                        quisquam animi ut id voluptatibus quis officia cupiditate a dolorum perspiciatis. Vero, doloremque.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Trending Products</h4>
                    <div class="underline"></div>
                </div>
                @if ($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel ">
                            @foreach ($trendingProducts as $key => $product)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <label class="stock bg-danger">New</label>
                                            @if ($product->images->count() > 0)
                                                <img src="{{ asset($product->images[0]->image) }}"
                                                    alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $product->brand?->name }}</p>
                                            <h5 class="product-name">
                                                <a
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
                            @endforeach

                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <h4 class="p-2">No Products Available</h4>
                    </div>
                @endif

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
