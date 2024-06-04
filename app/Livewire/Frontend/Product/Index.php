<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Color;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    // public $products;
    public $category;
    public $colors;
    public $brandCheck = [];
    public $colorCheck = [];
    public $priceCheck;

    function addToWishlist($product_id)
    {
        if(Auth::check())
        {
            $wishlist = WishList::where(['user_id' => Auth::id(), 'product_id' => $product_id])->first();

            if($wishlist)
            {
                session()->flash('message', 'Already have added Wishlist');
                $this->dispatch('alertyfy', [
                    'text'=> 'Already have added Wishlist',
                    'type' => 'warning',
                ]);
            }
            else
            {
                WishList::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ]);
                $this->dispatch('wishlist-deleted'); 
                $this->dispatch('alertyfy', [
                    'text'=> 'Added Wishlist Successfully',
                    'type' => 'success',
                ]);
            }
        } else {
            session()->flash('message', 'Please login to add product to wishlist');
        }

        
    }

    public function updated($property)
    {
        if ($property === 'colorCheck.0' || $property === 'priceCheck.0' || $property === 'brandCheck.0') {
            $this->resetPage();
        }
    }

    public function resetFilter()
    {
        $this->reset('brandCheck', 'colorCheck', 'priceCheck');
    }

    #[Computed()]
    public function products()
    {
        return Product::where('category_id', $this->category->id)
            ->when($this->brandCheck, function ($q) {
                return $q->whereIn('brand_id', $this->brandCheck);
            })
            ->when(
                $this->colorCheck,
                fn (Builder $builder, $colorId) => $builder->whereHas(
                    'colors.color',
                    fn (Builder $builder) => $builder->whereIn('colors.id', $colorId)
                )
            )
            ->when($this->priceCheck, function ($q) {
                $q->when($this->priceCheck == 'high-to-low', function ($q2) {
                    $q2->orderBy('selling_price', 'DESC');
                })->when($this->priceCheck == 'low-to-high', function ($q3) {
                    $q3->orderBy('selling_price', 'ASC');
                });
            })
            ->where('status', 0)->paginate(3);
    }
    
    public function render()
    {
        $this->colors = Color::whereHas('products.product', fn (Builder $builder) => $builder->where('products.category_id', $this->category->id))->get();
        
        return view('livewire.frontend.product.index', [
            'colors' => $this->colors,
            'category' => $this->category,
        ]);
    }
}
