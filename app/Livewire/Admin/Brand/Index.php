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

    public $name, $slug, $status;

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
        // dd($inputs);
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? 1 : 0,
        ]);

        session()->flash('message', 'Brand Added');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = $this->slug = $this->status = null;
    }
}
