<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function payment(Order $order) {

        $this->authorize('author', $order);
        $items = json_decode($order->content);
        $envio = json_decode($order->envio);
        // dd( $items);

        return view('orders.payment', compact('order', 'items', 'envio'));
    }

    public function show(Order $order) {
        $this->authorize('author', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);
        return view('orders.show', compact('order', 'items', 'envio'));
    }

    public function index() {
        $orders = Order::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pendiente = Order::where('status', 'PENDING')->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 'RECEIVED')->where('user_id', auth()->user()->id)->count();
        $enviado = Order::where('status', 'SENT')->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 'DELIVERED')->where('user_id', auth()->user()->id)->count();
        $cancelado = Order::where('status', 'CANCELED')->where('user_id', auth()->user()->id)->count();

        return view('orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'cancelado'));
    }

    public function pay(Order $order, Request $request){

        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-2703406764553486-111913-4895254bd5922043689aedb4d51d5adb-1556981132");
        
        $response = json_decode($response);

        $status = $response->status;

        if($status == "approved"){
            $order->status = 2;
            $order->save();
        }

        return redirect()->route('orders.show', $order); 
    }
}
