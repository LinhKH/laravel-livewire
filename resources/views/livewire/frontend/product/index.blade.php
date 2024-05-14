<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4>Brands</h4>
            </div>
            <div class="card-body">
                @forelse ($category->brands as $brand)

                <label class="form-check-label d-block py-2">
                    <input type="checkbox" wire:model.change="brandCheck" value="{{ $brand->id }}" class="form-check-input">
                <i class="input-helper"></i> {{ $brand->name }}</label>
                    
                @empty
                    <h3>No brand</h3>
                @endforelse

            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4>Price</h4>
            </div>
            <div class="card-body">

                <label class="form-check-label d-block py-2">
                    <input type="radio" wire:model.change="priceCheck" value="high-to-low" class="form-check-input">
                <i class="input-helper"></i> High to low</label>
                <label class="form-check-label d-block py-2">
                    <input type="radio" wire:model.change="priceCheck" value="low-to-high" class="form-check-input">
                <i class="input-helper"></i> Low to high</label>


            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div class="row">
            @forelse ($products as $key => $product)
    
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-card-img">
                        @if ($product->quantity > 0)
                        <label class="stock bg-success">In Stock</label>
                        @else
                        <label class="stock bg-danger">Out of Stock</label>
                        @endif
                        @if ($product->images->count() > 0)
                        <img src="{{ asset($product->images[0]->image) }}" alt="{{ $product->name }}">
    
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $product->brand?->name }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('collections/'. $product->category->slug .'/'.$product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="" class="btn btn1">Add To Cart</a>
                            <a href="javascript:void(0)" wire:click='addToWishlist({{ $product->id }})' class="btn btn1"> 
                                <span wire:loading.remove wire:target='addToWishlist({{ $product->id }})'>
                                    <i class="fa fa-heart"></i>
                                </span>
                                
                                <span wire:loading wire:target='addToWishlist({{ $product->id }})'>Adding...</span>
                            </a>
                            <a href="" class="btn btn1"> View </a>
                        </div>
                    </div>
                </div>
            </div>
    
            @empty
            <div class="col-md-12">
                <h4 class="p-2">No Products Available for {{ $category->name }}</h4>
            </div>
            @endforelse

        </div>

    </div>

</div>