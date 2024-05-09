<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $brand_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ];
    }
    public function render()
    {
        $brands = Brand::orderByDesc('id')->paginate(10);
        return view('livewire.admin.brand.index', compact('brands'))
            ->extends('layouts.admin')
            ->section('content');
    }

    public function storeBrand()
    {
        $this->validate();
        Brand::create([
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
        $this->slug = $brand->slug;
        $this->status = $brand->status == 1 ? true : false;
    }

    public function updateBrand()
    {
        $this->validate();
        Brand::findOrFail($this->brand_id)->update([
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
        $this->name = $this->slug = $this->status = $this->brand_id = null;
        $this->dispatch('close-modal');
    }
}
