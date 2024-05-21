@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h3>Products List
                    <a href="{{ route('products.create') }}" class="btn btn-danger btn-sm text-white float-end">Add
                        Product</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> <a href="{{ url('admin/categories/create') }}" type="button"
                                    class="btn btn-primary me-2 float-end">Add Category</a></h4><br />

                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Category
                                            </th>
                                            <th>
                                                Brand
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Trending
                                            </th>
                                            <th>
                                                Featured
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                {{ $product->id }}
                                            </td>
                                            <td>
                                                {{ $product->category?->name }}
                                            </td>
                                            <td>
                                                {{ $product->brand?->name }}
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {{ $product->status == '1' ? 'Hidden' : 'Visible' }}
                                            </td>
                                            <td>
                                                {{ $product->trending == '1' ? 'Trending' : 'Not Trending' }}
                                            </td>
                                            <td>
                                                {{ $product->featured == '1' ? 'Featured' : 'Not Featured' }}
                                            </td>
                                           
                                            <td>
                                                <a href="{{ url('/admin/products/' . $product->id . '/edit') }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ url('/admin/products/' . $product->id . '/delete') }}" onclick="return confirm('Are you sure delete?')"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection