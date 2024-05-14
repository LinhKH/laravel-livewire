<?php

namespace App\Livewire\Frontend\WishList;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class WishListCount extends Component
{

    public $wishListCount;

    #[On('wishlist-deleted')] 
    function checkWishListCount()
    {
        if(Auth::check()) {
            $this->wishListCount = \App\Models\WishList::where('user_id', auth()->user()->id)->count();
        }
        $this->wishListCount = $this->wishListCount > 0 ? $this->wishListCount : 0;
    }
    public function render()
    {
        $this->checkWishListCount();
        return view('livewire.frontend.wish-list.wish-list-count', [
            'wishListCount' => $this->wishListCount,
        ]);
    }
}
