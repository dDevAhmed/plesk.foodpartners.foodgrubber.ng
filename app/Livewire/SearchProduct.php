<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component
{
    public $products;

    public function searchProducts()
    {
        $this->products = Product::where('name', 'like', '%' . $this->searchKeyword . '%')
            ->orWhere('description', 'like', '%' . $this->searchKeyword . '%')
            ->get(); // Adjust query as needed
    }

    public function render()
    {
        return view('livewire.search-product');
    }
}
