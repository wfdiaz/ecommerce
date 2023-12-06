<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        
        $orders = Order::query()->where('status', '<>', 'PENDING');

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $recibido = Order::where('status', 'RECEIVED')->count();
        $enviado = Order::where('status', 'SENT')->count();
        $entregado = Order::where('status', 'DELIVERED')->count();
        $cancelado = Order::where('status', 'CANCELED')->count();

        return view('admin.orders.index', compact('orders', 'recibido', 'enviado', 'entregado', 'cancelado'));
    }

    public function show(Order $order) {
        return view('admin.orders.show',compact('order'));
    }
}
