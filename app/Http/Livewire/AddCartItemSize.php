<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{
    public $product, $sizes, $colors = [];
    public $color_id = "", $size_id = "";
    public $qty = 1, $quantity, $options;

    public function mount()
    {
        $this->sizes = $this->product->sizes;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }

    public function updatedSizeId($value)
    {
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
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

        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render');
    }
}
