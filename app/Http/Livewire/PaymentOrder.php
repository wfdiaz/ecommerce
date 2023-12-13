<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class PaymentOrder extends Component
{
    public $order;

    public function mount(Order $order){
        // dd($order);
        $this->order = $order;
    }


    public function render()
    {
        $items = json_decode($this->order->content);
        // dd($items);

        return view('livewire.payment-order', compact('items'));
    }
}
