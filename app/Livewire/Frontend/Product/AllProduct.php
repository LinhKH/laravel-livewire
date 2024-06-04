<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllProduct extends Component
{
    use WithPagination;

    public $categories = [];
    public $brands = [];
    public $colors = [];

    public $colorCheck = [];
    public $categoryCheck = [];
    public $brandCheck = [];
    public $priceCheck;

    public function resetFilter()
    {
        $this->reset();
    }

    public function updated($property)
    {
        if ($property === 'colorCheck.0' || $property === 'categoryCheck.0' || $property === 'brandCheck.0') {
            $this->resetPage();
        }
    }

    // public function updatedColorCheck()
    // {
    //     $this->resetPage();
    // }
    // public function updatedCategoryCheck()
    // {
    //     $this->resetPage();
    // }
    // public function updatedBrandCheck()
    // {
    //     $this->resetPage();
    // }

    function addToWishlist($product_id)
    {
        if (Auth::check()) {
            $wishlist = WishList::where(['user_id' => Auth::id(), 'product_id' => $product_id])->first();

            if ($wishlist) {
                session()->flash('message', 'Already have added Wishlist');
                $this->dispatch('alertyfy', [
                    'text' => 'Already have added Wishlist',
                    'type' => 'warning',
                ]);
            } else {
                WishList::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ]);
                $this->dispatch('wishlist-deleted');
                $this->dispatch('alertyfy', [
                    'text' => 'Added Wishlist Successfully',
                    'type' => 'success',
                ]);
            }
        } else {
            session()->flash('message', 'Please login to add product to wishlist');
        }
    }

    #[Computed()]
    public function products()
    {
        return  Product::where('status', 0)
            ->when(
                $this->colorCheck,
                fn (Builder $builder, $colorId) => $builder->whereHas(
                'colors.color',
                    fn (Builder $builder) => $builder->whereIn('colors.id', $colorId)
                )
            )
            ->when($this->categoryCheck, function ($q) {
                return $q->whereIn('category_id', $this->categoryCheck);
            })
            ->when($this->brandCheck, function ($q) {
                return $q->whereIn('brand_id', $this->brandCheck);
            })
            ->when($this->priceCheck, function ($q) {
                $q->when($this->priceCheck == 'high-to-low', function ($q2) {
                    $q2->orderBy('selling_price', 'DESC');
                })->when($this->priceCheck == 'low-to-high', function ($q3) {
                    $q3->orderBy('selling_price', 'ASC');
                });
            })
            ->where('status', 0)->paginate(6);
    }

    public function render()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->colors = Color::all();

        return view('livewire.frontend.product.all-product', [
            'categories' => $this->categories,
            'brands' => $this->brands,
        ])->extends('layouts.app');
    }
}
