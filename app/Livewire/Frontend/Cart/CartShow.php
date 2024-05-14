<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{

    function deleteWishlist($cart_id)
    {
        Cart::findOrFail($cart_id)->delete();

        $this->dispatch('cart-added-updated'); 

        $this->dispatch('alertyfy', [
            'text' => 'Product has been deleted from cart',
            'type' => 'success',
        ]);
        
    }
    public function render()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'carts' => $carts,
        ]);
    }
}
