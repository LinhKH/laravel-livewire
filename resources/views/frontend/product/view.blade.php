@extends('layouts.app')

@section('title')
{{ $product->meta_title }}
@endsection
@section('description')
{{ $product->meta_description }}
@endsection
@section('keywowrds')
{{ $product->meta_keyowrd }}
@endsection

@section('content')
<div>
    <livewire:frontend.product.view :product="$product" :category="$category">
</div>
@endsection