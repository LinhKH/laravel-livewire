<?php

namespace App\Livewire\Frontend\Product;

use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $product;
    public $category;

    public $productColorSelectedQty;

    function mount($product, $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    function colorSelected($color_id)
    {
        $productColrors = $this->product->colors()->where(['id' => $color_id])->first();
        $this->productColorSelectedQty = $productColrors->quantity == 0 ? 'outOfStock' : $productColrors->quantity;

        
    }

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
            // $this->dispatch('alertyfy', text: 'Please login to add product to wishlist');
            // return redirect()->route('login');
        }

        
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
        ]);
    }
}
