<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white border">
                    @if ($product->images->count() > 0)
                    <img src="{{ asset($product->images[0]->image) }}" class="w-100" alt="Img">
                        
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
                                <button wire:click='colorSelected({{ $color->id }})' class="form-check-label text-white" style="background-color: {{ $color->color->code }}">
                                {{ $color->color->name }}
                                </button>
                                
                            @endforeach
                            
                            <br/>
                            <div wire:loading class="mt-3"">  
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                            </div>
                            <div wire:loading.remove>
                                @if ($this->productColorSelectedQty =='outOfStock')
                                <label class="label-stock bg-danger mt-3">Out Of Stock</label>
                                
                                @elseif ($this->productColorSelectedQty > 0)
                                <label class="label-stock bg-success mt-3">In Stock</label>
                                @endif
                            </div>
                        @else
                            @if ($product->quantity > 0)
                                <label class="label-stock bg-success mt-3">In Stock</label>
                            @else
                            <label class="label-stock bg-danger mt-3">Out Of Stock</label>
                            @endif
                        @endif
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1"><i class="fa fa-minus"></i></span>
                            <input type="text" value="1" class="input-quantity" />
                            <span class="btn btn1"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                        <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
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