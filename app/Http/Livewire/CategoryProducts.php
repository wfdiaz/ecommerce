<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryProducts extends Component
{
    public $category;
    public $products = [];

    public function render() {
        return view('livewire.category-products');
    }

    public function loadProducts() {
        $this->products = $this->category->products()->where('status', 2)->orderBy('order', 'asc')->take('15')->get();
        $this->emit('glid', $this->category->id);
    }
}
