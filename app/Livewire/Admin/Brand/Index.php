<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $brand_id, $category_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable',
        ];
    }
    public function render()
    {
        $brands = Brand::orderByDesc('id')->paginate(10);
        $categories = Category::all();
        return view('livewire.admin.brand.index', compact('brands','categories'))
            ->extends('layouts.admin')
            ->section('content');
    }

    public function storeBrand()
    {
        $this->validate();
        Brand::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? 1 : 0,
        ]);

        $this->dispatch('alertyfy', text: 'Brand Added Successfully');
        $this->resetInput();
    }

    public function editBrand($brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->category_id = $brand->category_id;
        $this->slug = $brand->slug;
        $this->status = $brand->status == 1 ? true : false;
    }

    public function updateBrand()
    {
        $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? 1 : 0,
        ]);

        $this->dispatch('alertyfy', text: 'Brand Updated Successfully');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }
    
    public function destroyBrand()
    {
        $brand = Brand::findOrFail($this->brand_id);
       
        $brand->delete();

        $this->dispatch('alertyfy', text: 'Brand Deleted Successfully');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }
    public function resetInput()
    {
        $this->name = $this->slug = $this->status = $this->brand_id = $this->category_id = null;
        $this->dispatch('close-modal');
    }
}
