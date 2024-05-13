<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

    public $products;
    public $category;
    public $brandCheck = [];
    public $priceCheck;


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
                        ->when($this->priceCheck, function($q){
                            $q->when($this->priceCheck == 'high-to-low', function($q2) {
                                $q2->orderBy('selling_price', 'DESC');
                            })->when($this->priceCheck == 'low-to-high', function($q3) {
                                $q3->orderBy('selling_price', 'ASC');
                            });
                        })
                        ->where('status', 0)->get();
        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}
