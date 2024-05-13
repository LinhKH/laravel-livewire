<?php

namespace App\Livewire\Frontend\WishList;

use App\Models\WishList;
use Livewire\Component;

class Show extends Component
{

    function deleteWishlist($wish_list_id)
    {
        WishList::findOrFail($wish_list_id)->delete();

        $this->dispatch('alertyfy', [
            'text' => 'Product has been deleted from wishlist',
            'type' => 'success',
        ]);
    }
    public function render()
    {
        $wishlists = WishList::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wish-list.show', [
            'wishlists' => $wishlists,
        ]);
    }
}
