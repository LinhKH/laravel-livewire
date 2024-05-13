<?php

namespace App\Livewire\Frontend\WishList;

use App\Models\WishList;
use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        $wishlists = WishList::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wish-list.show', [
            'wishlists' => $wishlists,
        ]);
    }
}
