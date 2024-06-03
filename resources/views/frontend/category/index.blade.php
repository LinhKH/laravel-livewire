@extends('layouts.app')

@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">Our Categories</h4>
                <div class="underline mb-4 "></div>
            </div>
            @forelse ($categories as $category)
            <div class="col-6 col-md-3 d-flex justify-content-center mt-5">
                <div class="card p-3 bg-white">
                    <a href="{{ url('collections/' .$category->slug) }}">
                        <div class="about-product text-center mt-2">
                            <img src="{{ asset($category->image) }}" width="200" alt="{{ $category->name }}">
                            <div>
                                <h4>{{ $category->name }}</h4>
                            </div>
                        </div>
                    
                    </a>
                </div>
            </div>
            @empty
            <div class="col-md-12">No categories available</div>
            @endforelse

        </div>
    </div>
</div>
@endsection