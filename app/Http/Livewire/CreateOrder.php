<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Departament;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CreateOrder extends Component
{
    public $departaments, $cities = [];
    public $departament_id = "", $city_id = "";
    public $contact, $phone, $address, $reference, $shipping_cost = 0;
    public $envio_type = 1;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required',
    ];

    public function mount() {
        $this->departaments = Departament::all();
    }

    public function render()
    {
        return view('livewire.create-order');
    }

    public function createOrder() {
        $rules = $this->rules;

        if($this->envio_type == 2) {
            $rules['departament_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['address'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules);

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = $this->shipping_cost;
        $order->total = floatval(str_replace(',','',Cart::subtotal())) + $this->shipping_cost;
        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            $order->shipping_cost = $this->shipping_cost;

            $order->envio = json_encode([
                'department' => Departament::find($this->departament_id)->name,
                'city' => City::find($this->city_id)->name,
                'address' => $this->address,
                'references' => $this->reference
            ]);
        }

        $order->save();

        foreach(Cart::content() as $item) {
            discount($item);
        }

        Cart::destroy();

        return redirect()->route('orders.payment', $order);
    }

    public function updatedEnvioType($value) {
        if($value == 1) {
            $this->resetValidation([ 'departament_id', 'city_id', 'address', 'reference']);
            $this->reset('shipping_cost');
        }
    }

    public function updatedDepartamentId($value) {
        $this->cities = City::where('departament_id',$value)->get();
        $this->reset('city_id');
    }

    public function updatedCityId($value) {
        $this->shipping_cost = City::find($value)->cost;
    }
}
