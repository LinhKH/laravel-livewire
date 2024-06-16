<div class="py-3 py-md-5 bg-light">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>Total</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>
                    @forelse ($carts as $cart)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-5 my-auto">
                                    <a
                                        href="{{ url('/collections/' . $cart->product->category->slug . '/' . $cart->product->slug) }}">
                                        <label class="product-name">
                                            @if ($cart->product?->images->count() > 0)
                                                <img src="{{ asset($cart->product?->images[0]?->image) }}"
                                                    style="width: 50px; height: 50px" alt="">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif

                                            @if ($cart->product_color)
                                                <span>{{ $cart->product->name . ' - Color: ' . $cart->product_color->color->name }}</span>
                                            @else
                                                <span>{{ $cart->product->name }}</span>
                                            @endif
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">$ {{ $cart->product->selling_price }} </label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <span class="btn btn1"
                                                wire:click='descrementCartQty({{ $cart->id }})'><i
                                                    class="fa fa-minus"></i></span>
                                            <input type="text" min="0" value="{{ $cart->quantity }}"
                                                class="input-quantity" />
                                            <span class="btn btn1" wire:click='incrementCartQty({{ $cart->id }})'><i
                                                    class="fa fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 my-auto">
                                    <label class="price">$ {{ $cart->product->selling_price * $cart->quantity }}
                                    </label>
                                    @php $totalPrice += $cart->product->selling_price * $cart->quantity @endphp
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <a href="javascript:void(0)" wire:click="deleteCartItem({{ $cart->id }})"
                                            wire:confirm="Are you sure you want to delete this cart?"
                                            class="btn btn-danger btn-sm">

                                            <span wire:loading.remove
                                                wire:target='deleteCartItem({{ $cart->id }})'>
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                            <span wire:loading wire:target='deleteCartItem({{ $cart->id }})'>
                                                <i class="fa fa-trash"></i> Removing
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
        @if ($carts->count() > 0)
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h5>Get the best deals & offers <a href="{{ url('/collections') }}">Shop now</a></h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Grand Total: <span class="float-end">$ {{ $totalPrice }}</span></h4>
                        <hr>
                        <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@script
    <script>
        $wire.on('cart-confirm-deleted', (event) => {
            var result = confirm("Want to delete?");
            if (result) {
                $wire.dispatch('cart-delete', event);
            }
        });
    </script>
@endscript
