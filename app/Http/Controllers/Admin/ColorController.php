<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    function index()
    {
        $colors = Color::orderByDesc('id')->paginate(3);
        return view('admin.color.index', compact('colors'));
    }

    function create()
    {
        return view('admin.color.create');
    }

    function store(ColorFormRequest $request)
    {
        $validatedData = $request->validate([
            'name' =>'required',
            'code' =>'required',
        ]);

        $color = new Color;
        $color->name = $validatedData['name'];
        $color->code = $validatedData['code'];
        $color->status = $request->has('status') ? 1 : 0;
        $color->save();

        return redirect()->route('color.index')->with('message','Color Added Successfully');;
    }

    function edit(Color $color)
    {
        return view('admin.color.edit', compact('color'));
    }

    function update(ColorFormRequest $request, Color $color)
    {
        $validatedData = $request->validate([
            'name' =>'required',
            'code' =>'required',
        ]);

        $color->name = $validatedData['name'];
        $color->code = $validatedData['code'];
        $color->status = $request->has('status') ? 1 : 0;
        $color->save();

        return redirect()->route('color.index')->with('message','Color Updated Successfully');;
    }

    function destroy(Color $color)
    {

        $color->delete();
        
        return redirect()->route('color.index')->with('message','Color Deleted Successfully');
    }
}
