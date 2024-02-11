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
        // $this->envio = json_decode($this->order->envio);
    }


    public function render()
    {
        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items', 'envio'));
    }
}
