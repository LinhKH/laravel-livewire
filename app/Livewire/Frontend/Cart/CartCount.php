<?php

namespace App\Livewire\Frontend\Cart;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{

    public $cartCount;

    #[On('cart-added-updated')] 
    function checkCartCount()
    {
        if(Auth::check()) {
            $this->cartCount = \App\Models\Cart::where('user_id', auth()->user()->id)->count();
        }
        $this->cartCount = $this->cartCount > 0 ? $this->cartCount : 0;
    }

    public function render()
    {
        $this->checkCartCount();
        return view('livewire.frontend.cart.cart-count', [
            'cartCount' => $this->cartCount,
        ]);
    }
}
