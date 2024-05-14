<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartShow extends Component
{

    public $cartQuantity;

    #[On('cart-delete')]
    function deleteCartItem($cart_id)
    {
        Cart::findOrFail($cart_id)->delete();

        $this->dispatch('cart-added-updated');

        $this->dispatch('alertyfy', [
            'text' => 'Product has been deleted from cart',
            'type' => 'success',
        ]);
    }

    function descrementCartQty(int $cart_id)
    {
        $cart = Cart::findOrFail($cart_id);

        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        } else {
            $this->dispatch('cart-confirm-deleted', $cart_id);
        }
    }
    function incrementCartQty(int $cart_id)
    {
        $cart = Cart::where('id', $cart_id)->first();
        
        if ($cart) {
            if($cart->product_color && $cart->product_color->where('id',$cart->product_color_id)->exists()) {
                $productColor = $cart->product_color->where('id',$cart->product_color_id)->first();
                if ($productColor->quantity > $cart->quantity) {
                    $cart->increment('quantity');
                   
                } else {
                    $this->dispatch('alertyfy', [
                        'text' => 'Only '. $productColor->quantity. ' Quantity Available',
                        'type' => 'error',
                    ]);
                }

            } else {
                if($cart->product->quantity > $cart->quantity)
                {
                    $cart->increment('quantity');
                    
                } else {
                    $this->dispatch('alertyfy', [
                        'text' => 'Only '. $cart->product->quantity. ' Quantity Available',
                        'type' => 'error',
                    ]);
                }
            }
        }
    }
    public function render()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'carts' => $carts,
        ]);
    }
}
