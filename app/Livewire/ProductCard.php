<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCard extends Component
{

    public $product;
    public $isLoading;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function activate()
    {
        $this->isLoading = true;
        $this->product->availability = 1;
        $this->product->save();
        $this->isLoading = false;

        // fixme - fix thiis
        // $this->emit('productActivated', $this->product->id);
        // $this->emit('successMessage', 'Product activated successfully!');
    }

    public function deactivate()
    {
        $this->product->availability = 0;
        $this->product->save();

        // fixme - fix thiis
        // $this->emit('productDeactivated', $this->product->id);
        // $this->emit('successMessage', 'Product deactivated successfully!');
    }

    public function delete()
    {
        $this->product->delete();
        return redirect()->route('products.index'); 

        // fixme - fix thiis
        // $this->emit('productDeleted', $this->product->id);
        // $this->emit('successMessage', 'Product deleted successfully!');
        // $this->refresh();  // Re-render the component
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
