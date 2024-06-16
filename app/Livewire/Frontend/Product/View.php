<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class View extends Component
{
    public $product;
    public $category;
    public $productColorId;
    public $quantityCount = 1;

    public $productColorSelectedQty;

    function mount($product, $category)
    {
        $this->product = $product;
        $this->category = $category;
    }
    #[Computed()]
    public function productExists()
    {
        if (auth()->check()) {
            return WishList::where('product_id', $this->product->id)->where('user_id', auth()->user()->id)->exists();
        } else {
            return false;
        }
    }

    function colorSelected($product_color_id)
    {
        $this->productColorId = $product_color_id;
        $productColrors = $this->product->colors()->where(['id' => $product_color_id])->first();
        $this->productColorSelectedQty = $productColrors->quantity == 0 ? 'outOfStock' : $productColrors->quantity;

    }

    function descrementQty()
    {
        if($this->quantityCount > 0)
        {
            $this->quantityCount--;
        }
    }
    function incrementQty()
    {
        $this->quantityCount++;
    }

    function addToCard($product_id)
    {
        if(Auth::check())
        {
            if($this->product->where(['id' => $product_id])->where('status','0')->exists())
            {
                if($this->product->colors->count() > 0){
                    if($this->productColorSelectedQty != null) {
                        //color selected

                        if($this->productColorSelectedQty != 'outOfStock')
                        {
                            if(Cart::where('user_id', Auth::id())->where('product_id', $product_id)->where('product_color_id',$this->productColorId)->exists())
                            {
                                $this->dispatch('alertyfy', [
                                    'text'=> 'Product Already Added to card',
                                    'type' =>'warning',
                                ]);
                            } else {
                                if($this->productColorSelectedQty >= $this->quantityCount) {
                                    // add to card with color
                                    // dd('add to card with color');
        
                                    Cart::create([
                                        'user_id' => Auth::id(),
                                        'product_id' => $product_id,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);
                                    $this->dispatch('cart-added-updated');
                                    $this->dispatch('alertyfy', [
                                        'text'=> 'Product added to card',
                                        'type' =>'success',
                                    ]);
                                } else {
                                    // add to card without color
                                    // dd('add to card without color');
                                    $this->dispatch('alertyfy', [
                                        'text'=> 'Only '.$this->productColorSelectedQty.' Quantity Available',
                                        'type' => 'warning',
                                    ]);
                                }
                            }
                        }


                    } else {
                        $this->dispatch('alertyfy', [
                            'text'=> 'Please select color',
                            'type' => 'error',
                        ]);
                    }
                } else {
                    if(Cart::where('user_id', Auth::id())->where('product_id', $product_id)->exists())
                    {
                        $this->dispatch('alertyfy', [
                            'text'=> 'Product Already Added to card',
                            'type' =>'warning',
                        ]);
                    } else {
                        if($this->product->quantity > 0)
                        {
                            if($this->product->quantity >= $this->quantityCount)
                            {
                                Cart::create([
                                    'user_id' => Auth::id(),
                                    'product_id' => $product_id,
                                    'quantity' => $this->quantityCount,
                                ]);
                                $this->dispatch('cart-added-updated');
                                $this->dispatch('alertyfy', [
                                    'text'=> 'Product added to card',
                                    'type' =>'success',
                                ]);
                            } else {
                                $this->dispatch('alertyfy', [
                                    'text'=> 'Only '.$this->product->quantity.' Quantity Available',
                                    'type' => 'warning',
                                ]);
                            }
                        } else {
                            $this->dispatch('alertyfy', [
                                'text'=> 'Product is out of stock',
                                'type' => 'warning',
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatch('alertyfy', [
                    'text'=> 'Product is not available',
                    'type' => 'warning',
                ]);
            }
        } else {
            $this->dispatch('alertyfy', [
                'text'=> 'Please login to add product to card',
                'type' =>'warning',
            ]);
        }
    }

    function addToWishlist($product_id)
    {
        if(Auth::check())
        {
            $wishlist = WishList::where(['user_id' => Auth::id(), 'product_id' => $product_id])->first();

            if($wishlist)
            {
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

    function removeWishlist($product_id)
    {
        WishList::where('product_id', $product_id)->where('user_id', auth()->user()->id)->delete();
        $this->dispatch('wishlist-deleted');
        $this->dispatch('alertyfy', [
            'text' => 'Remove Wishlist Successfully',
            'type' => 'success',
        ]);
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
        ]);
    }
}
