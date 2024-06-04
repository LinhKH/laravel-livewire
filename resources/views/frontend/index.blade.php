@extends('layouts.app')
@section('sliders')
{{-- @include('layouts.inc.frontend.slider') --}}
<!-- Hero 6 - Bootstrap Brain Component -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid bsb-hero-6 bsb-overlay border border-dark"
                    style="--bsb-overlay-opacity: 0.5; --bsb-overlay-bg-color: var(--bs-light-rgb); background-image: url('./assets/img/hero-img-1.webp');">
                    <div class="row justify-content-md-center align-items-center">
                        <div class="col-12 col-md-11 col-xl-10">
                            <h2 class="display-1 text-center text-md-start text-shadow-head fw-bold mb-4">Welcome to
                                Linh Kieu's Shop Ecommerce</h2>
                            <p
                                class="lead text-center text-md-start text-shadow-body mb-5 d-flex justify-content-sm-center justify-content-md-start">
                                <span class="col-12 col-sm-10 col-md-8 col-xxl-7">Where every squeak, every rattle, and
                                    every wobble finds its solution, ensuring your ride is always smooth and
                                    worry-free.</span>
                            </p>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center justify-content-md-start">
                                <a wire:navigate href="/shop" class="btn bsb-btn-2xl btn-outline-dark">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<section class="py-3 py-md-5">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="mb-4 display-5 text-center text-uppercase">Trending Products</h2>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
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
                        <img src="{{ asset($product->images[0]->image) }}" alt="{{ $product->name }}">
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
            @endforeach

        </div>

    </div>
    @else
    <div class="col-md-12">
        <h4 class="p-2">No Products Available</h4>
    </div>
    @endif
</section>

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