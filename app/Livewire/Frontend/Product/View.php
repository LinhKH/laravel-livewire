<?php

namespace App\Livewire\Frontend\Product;

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
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
        ]);
    }
}
