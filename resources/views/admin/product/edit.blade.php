@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h3>Edit Products
                    <a href="{{ route('products.index') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                @endif
                <form class="forms-sample" method="POST" action="{{ url('/admin/products/'.$product->id.'/edit') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                type="button" role="tab" aria-controls="seo" aria-selected="false">SEO Tag</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail"
                                type="button" role="tab" aria-controls="detail" aria-selected="false">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="product-image-tab" data-bs-toggle="tab"
                                data-bs-target="#product-image" type="button" role="tab" aria-controls="product-image"
                                aria-selected="false">Images</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                                type="button" role="tab" aria-controls="gallery" aria-selected="false">Color</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Please select</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category->id ?
                                        'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Please select</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand->id ? 'selected' :
                                        '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" value="{{ $product->slug }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="small_description">Small Description</label>
                                <textarea type="text" name="small_description" value="{{ $product->small_description }}"
                                    class="form-control" rows="3">{{ $product->small_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" value="{{ $product->description }}"
                                    class="form-control" rows="3">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                            <div class="mb-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $product->meta_title }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" name="meta_keyword" value="{{ $product->meta_keyword }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea type="text" name="meta_description" value="{{ $product->meta_description }}"
                                    class="form-control" rows="3">{{ $product->meta_description }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="original_price">Original Price</label>
                                        <input type="text" name="original_price" value="{{ $product->original_price }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="selling_price">Selling Price</label>
                                        <input type="text" name="selling_price" value="{{ $product->selling_price }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" value="{{ $product->quantity }}" min="0"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="trending" value="{{ $product->trending }}" {{
                                                $product->trending == 1 ? 'checked' : '' }} class="form-check-input">
                                            Trending
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="featured" value="{{ $product->featured }}" {{
                                                $product->featured == 1 ? 'checked' : '' }} class="form-check-input">
                                            Featured
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="status" value="{{ $product->status }}" {{
                                                $product->status == 1 ? 'checked' : '' }} class="form-check-input">
                                            Status
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="product-image" role="tabpanel"
                            aria-labelledby="product-image-tab">
                            <div class="mt-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" name="image[]" type="file" id="formFile" multiple>
                            </div>
                            <div>
                                   
                                @if ($product->images)
                                    <div class="row">
                                        @foreach ($product->images as $image)
                                        <div class="col-md-2">
                                            <img src="{{ asset('/'). $image->image }}" width="60" height="60" class="mt-3" />
                                            <a class="d-block" href="{{ route('products.image.delete', $image->id) }}" >Delete</a>

                                        </div>
                                        @endforeach

                                    </div>
                                    
                                @else
                                <h5>No Image</h5>
                                @endif
                                
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="gallery" role="tabpanel"
                            aria-labelledby="gallery-tab">
                            <div class="row">
                                <label >Select Colors</label>
                                @forelse ($colorsNotIn as $key => $color)
                                <div class="col-md border">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label"><input type="checkbox" name="colors[]" value="{{ $color->id }}" class="form-check-input">{{ $color->name }} <i class="input-helper"></i></label>
                                    </div>
                                    <div>
                                        Quantity : <input type="number" min="0" name="quantities[]"  class="form-control">
                                    </div>

                                </div>
                                    
                                @empty
                                    <div class="col-md-12"><h2>No Data</h2></div>
                                @endforelse

                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Color</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->colors as $key => $pcolor)
                                            <tr class="product-color">
                                                <td>{{ $pcolor->color?->name }}</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <input type="number" min="0" value="{{ $pcolor->quantity }}"  class="form-control productColorQty">
                                                        <button type="button" class="btn btn-primary updateProductColor" value="{{ $pcolor->id }}">Update</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger deleteProductColor" value="{{ $pcolor->id }}">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updateProductColor', function(e) {
                e.preventDefault();

                var product_color_id = $(this).val();
                
                var product_id = "{{ $product->id }}";

                var product_color_qty = $(this).closest('.product-color').find('.productColorQty').val();

                if (product_color_qty <=0)
                {
                    alert('Quantity must be greater than 0');
                    return false;
                }

                var data = {
                    'product_id' : product_id,
                    'product_color_qty' : product_color_qty
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/products/product-color/"+product_color_id+"/update",
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(data.message + '!');
                    }
                });
            });
            $(document).on('click', '.deleteProductColor', function(e) {
                e.preventDefault();
                
                var product_color_id = $(this).val();
                var thisClick =  $(this)

                if(confirm("Are you sure you want to delete this?")){
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/products/product-color/"+product_color_id+"/delete",
                    type: 'GET',
                    success: function(data) {
                        thisClick.closest('.product-color').remove();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(data.message + '!');
                    }
                });
                }
                else{
                    return false;
                }

            });
        });
    </script>
@endpush