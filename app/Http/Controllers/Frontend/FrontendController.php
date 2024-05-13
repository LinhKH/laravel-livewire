<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        return view('frontend.index');
    }
    function categories()
    {
        $categories = Category::all();
        return view('frontend.category.index', compact('categories'));
    }

    function prooducts($category_slug)
    {

        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $products = $category->products()->with('images')->get();
        } else {
            return redirect()->back();
        }
        return view('frontend.product.index', compact('products', 'category'));
    }

    function prooductDetail(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category)
        {
            $product = $category->products()->where('slug', $product_slug)->with('images')->first();
            if ($product)
            {
                return view('frontend.product.view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
