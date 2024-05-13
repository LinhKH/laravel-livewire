<div class="py-3 py-md-5 bg-light">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>
                    @forelse ($wishlists as $wishlist)
                    <div class="cart-item">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <a
                                    href="{{ url('/collections/'.$wishlist->product->category->slug. '/'. $wishlist->product->slug) }}">
                                    <label class="product-name">
                                        @if ($wishlist->product?->images->count() > 0)
                                        <img src="{{ asset($wishlist->product?->images[0]?->image) }}"
                                            style="width: 50px; height: 50px" alt="">
                                        @else
                                        <img src="" style="width: 50px; height: 50px" alt="">
                                        @endif
                                        <span>{{ $wishlist->product->name }}</span>
                                    </label>
                                </a>
                            </div>
                            <div class="col-md-2 my-auto">
                                <label class="price">$ {{ $wishlist->product->selling_price }} </label>
                            </div>
                            <div class="col-md-2 col-7 my-auto">
                                <div class="quantity">
                                    <div class="input-group">
                                        <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                        <input type="number" min="0" value="1" class="input-quantity" />
                                        <span class="btn btn1"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-5 my-auto">
                                <div class="remove">
                                    <a href="javascript:void(0)" wire:click="deleteWishlist({{ $wishlist->id }})"
                                        wire:confirm="Are you sure you want to delete this wishlist?"
                                        class="btn btn-danger btn-sm">

                                        <span wire:loading.remove wire:target='deleteWishlist({{ $wishlist->id }})'>
                                            <i class="fa fa-trash"></i>Remove
                                        </span>
                                        <span wire:loading wire:target='deleteWishlist({{ $wishlist->id }})'>
                                            <i class="fa fa-trash"></i>Removing
                                        </span>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="col-md-12 text-center">
                        <h3>No data</h3>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>