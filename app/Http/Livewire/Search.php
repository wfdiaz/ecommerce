<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search, $open = false;

    public function render()
    {
        if($this->search) {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
                    ->where('status', 2)->take(5)->get();

        } else {
            $products = [];
        }

        if(count($products) > 0) {
            $this->open = true;
        } else {
            $this->open = false;
        }

        return view('livewire.search', compact('products'));
    }

    public function clear() {
        $this->reset('search','open');
    }
}
