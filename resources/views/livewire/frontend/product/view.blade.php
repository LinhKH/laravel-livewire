<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-md-5 mt-3">
                <div class="bg-white border" wire:ignore>
                    @if ($product->images->count() > 0)

                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach ($product->images as $pImage)
                                        <li><img src="{{ asset($pImage->image) }}" /></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>

                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn">
                                    < </a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $product->name }}

                    </h4>
                    <hr>
                    <p class="product-path">
                        Home / {{ $product->category?->name }} / {{ $product->name }}
                    </p>
                    <div>
                        <span class="selling-price">$ {{ $product->selling_price }}</span>
                        <span class="original-price">$ {{ $product->original_price }}</span>
                    </div>
                    <div class="form-group">
                        @if ($product->colors->count() > 0)
                            @foreach ($product->colors as $color)
                                <button wire:click='colorSelected({{ $color->id }})'
                                    class="form-check-label text-white"
                                    style="background-color: {{ $color->color->code }}">
                                    {{ $color->color->name }}
                                </button>
                            @endforeach

                            <br />

                            <div wire:loading wire:target='colorSelected' class="spinner-border text-primary mt-3"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                            <div wire:loading.remove wire:target='colorSelected'>
                                @if ($this->productColorSelectedQty == 'outOfStock')
                                    <label class="label-stock bg-danger mt-3">Out Of Stock</label>
                                @elseif ($this->productColorSelectedQty > 0)
                                    <label class="label-stock bg-success mt-3">In Stock(
                                        {{ $this->productColorSelectedQty }})</label>
                                @endif
                            </div>
                        @else
                            @if ($product->quantity > 0)
                                <label class="label-stock bg-success mt-3">In Stock ({{ $product->quantity }})</label>
                            @else
                                <label class="label-stock bg-danger mt-3">Out Of Stock</label>
                            @endif
                        @endif
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1" wire:click='descrementQty'><i class="fa fa-minus"></i></span>
                            <input type="number" min="0" wire:model='quantityCount'
                                value="{{ $this->quantityCount }}" class="input-quantity" />
                            <span class="btn btn1" wire:click='incrementQty'><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button href="javascript:void(0)"
                            {{ $this->productColorSelectedQty == 'outOfStock' ? 'disabled' : '' }} class="btn btn1"
                            wire:click='addToCard({{ $product->id }})'>
                            <span wire:loading.remove wire:target='addToCard'>
                                <i class="fa fa-shopping-cart"></i> Add To Cart

                            </span>
                            <span wire:loading wire:target='addToCard'><i
                                    class="fa fa-shopping-cart"></i>Adding...</span>
                        </button>
                        @if (!$this->productExists)
                        <a href="javascript:void(0)" wire:click='addToWishlist({{ $product->id }})' class="btn btn1">
                            <span wire:loading.remove wire:target='addToWishlist'>
                                <i class="fa-regular fa-heart"></i> Add To Wishlist
                            </span>

                            <span wire:loading wire:target='addToWishlist'>Loading...</span>
                        </a>
                        @else
                        <a href="javascript:void(0)" wire:click='removeWishlist({{ $product->id }})' class="btn btn1">
                            <span wire:loading.remove wire:target='removeWishlist'>
                                <i class="fa-solid fa-heart"></i></i> Remove Wishlist
                            </span>

                            <span wire:loading wire:target='removeWishlist'>Loading...</span>
                        </a>

                        @endif
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Small Description</h5>
                        <p>
                            {{ $product->small_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Description</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({

                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                // autoplay
                "autoPlay": true,

                // autoplay interval in milliseconds
                "autoPlayTimeout": 2000

            });

        });
    </script>
@endpush
