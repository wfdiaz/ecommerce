<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class UpdateCartItem extends Component
{
    public $rowId, $qty, $quantity;

    public function mount()
    {
        $item = Cart::get($this->rowId);
        $this->quantity = qty_available($item->id);
        $this->qty = $item->qty;
    }

    public function render()
    {
        return view('livewire.update-cart-item');
    }

    public function increment()
    {
        $this->qty += 1;
        Cart::update($this->rowId, $this->qty);
        $item = Cart::get($this->rowId);
        $this->quantity = qty_available($item->id);
        $this->emit('render');
    }

    public function decrement()
    {
        $this->qty -= 1;
        Cart::update($this->rowId, $this->qty);
        $item = Cart::get($this->rowId);
        $this->quantity = qty_available($item->id);
        
        $this->emit('render');
    }
}
