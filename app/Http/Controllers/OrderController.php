<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function payment(Order $order) {
        $this->authorize('author', $order);
        $items = json_decode($order->content);
        return view('orders.payment', compact('order', 'items'));
    }

    public function show(Order $order) {
        $this->authorize('author', $order);

        $items = json_decode($order->content);

        return view('orders.show', compact('order', 'items'));
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
}
