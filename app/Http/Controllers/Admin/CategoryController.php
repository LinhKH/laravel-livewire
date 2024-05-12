<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    function index()
    {
        return view('admin.category.index');
    }
    function create()
    {
        return view('admin.category.create');
    }
    function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')) {
            $sPath = 'uploads/category/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext;
            $file->move($sPath, $file_name);
            $category->image = '/'.$sPath. $file_name;
        }

        $category->meta_title =  $validatedData['meta_title'];
        $category->meta_keyword =  $validatedData['meta_keyword'];
        $category->meta_description =  $validatedData['meta_description'];
        $category->status = $request->has('status') ? 1 : 0;
        $category->save();

        return redirect()->route('categories.index')->with('message','Category Added Successfully');

    }

    function edit(Category $category) {
        return view('admin.category.edit', compact('category'));
    }

    function update(CategoryFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')) {
            $sPath = 'uploads/category/';
            if (File::exists($sPath.$category->image)) {
                File::delete($sPath.$category->image);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext;
            $file->move($sPath, $file_name);
            $category->image = '/'.$sPath . $file_name;
        }

        $category->meta_title =  $validatedData['meta_title'];
        $category->meta_keyword =  $validatedData['meta_keyword'];
        $category->meta_description =  $validatedData['meta_description'];
        $category->status = $request->has('status') ? '1' : '0';
        $category->save();

        return redirect()->route('categories.index')->with('message','Category Updated Successfully');

    }
}
