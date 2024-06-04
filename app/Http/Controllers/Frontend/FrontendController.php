<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        $sliders = Product::where('status', 0)->get();
        $trendingProducts = Product::where('status', 0)->where('trending', 1)->latest()->take(15)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts'));
    }
    function newArrivals()
    {
        $newArrivals = Product::where('status', 0)->latest()->take(16)->get();
        return view('frontend.pages.new-arrivals', compact('newArrivals'));
    }
    function featuredProducts()
    {
        $featuredProducts = Product::where('status', 0)->where('featured', 1)->latest()->take(16)->get();
        return view('frontend.pages.featured', compact('featuredProducts'));
    }
    function categories()
    {
        $categories = Category::all();
        return view('frontend.category.index', compact('categories'));
    }

    function products($category_slug)
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
