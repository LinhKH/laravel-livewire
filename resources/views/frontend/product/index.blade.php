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

            <livewire:frontend.product.index :products="$products" :category="$category" :wire:key="'item-'.$category->id" />

        </div>
    </div>
</div>
@endsection