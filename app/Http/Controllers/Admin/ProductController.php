<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    function index()
    {
        return view('admin.product.index');
    }
    function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    function store(ProductFormRequest $request)
    {
        $inputs = $request->validated();
        $category = Category::findOrFail($inputs['category_id']);

        $product = new Product;
        $product->category_id = $category->id;
        $product->name = $inputs['name'];
        $product->slug = Str::slug($inputs['slug']);
        $product->brand_id = $inputs['brand_id'];
        $product->small_description = $inputs['small_description'];
        $product->description = $inputs['description'];
        $product->original_price = $inputs['original_price'];
        $product->selling_price = $inputs['selling_price'];
        $product->quantity = $inputs['quantity'];
        $product->trending = $request->has('trending') ? 1 : 0;
        $product->status = $request->has('status') ? 1 : 0;
        $product->meta_title = $inputs['meta_title'];
        $product->meta_keyword = $inputs['meta_keyword'];
        $product->meta_description = $inputs['meta_description'];

        $product->save();

        if ($request->hasFile('image')) {
            $sPath = 'uploads/category/';
            
            foreach ($request->file('image') as $key => $file) {
                
                $ext = $file->getClientOriginalExtension();
                $file_name = time().$key . '.' . $ext;
                $file->move($sPath, $file_name);

                $product->images()->create([
                    // 'product_id' => $product->id, // not need declare because relationship
                    'image' => $sPath . $file_name,
                ]);
            }
        }

        return redirect()->route('products.index')->with('message','Product Added Successfully');
    }
}
