<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{
    public $product, $colors, $color_id = "";
    public $qty = 1, $quantity = 0;
    public $options = ['size_id' => null];

    public function mount()
    {
        $this->colors = $this->product->colors;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

    public function updatedColorId($value)
    {
        $color = $this->product->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }

    public function increment()
    {
        $this->qty += 1;
    }

    public function decrement()
    {
        $this->qty -= 1;
    }

    public function addItem()
    {
       $cart = Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'weight' => 500,
            'options' => $this->options
        ]);

        if($this->product->getDiscount()) {
            Cart::setDiscount($cart->rowId,$this->product->getDiscount());
        }

        $this->quantity = qty_available($this->product->id, $this->color_id);
        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }
}
