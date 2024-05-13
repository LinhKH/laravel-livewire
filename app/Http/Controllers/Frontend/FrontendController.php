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
}
