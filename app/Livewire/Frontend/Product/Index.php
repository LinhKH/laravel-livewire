<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

    public $products;
    public $category;
    public $brandCheck = [];


    public function mount($products, $category)
    {
        $this->products = $products;
        // $this->category = $category;
    }
    public function render()
    {
        $this->products = Product::where('category_id', $this->category->id)
                        ->when($this->brandCheck, function($q){
                            return $q->whereIn('brand_id', $this->brandCheck);
                        })
                        ->where('status', 0)->get();
        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}
