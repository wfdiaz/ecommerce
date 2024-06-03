<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke() {
        if(auth()->user()){
            $pendiente = Order::where('status', 'PENDING')->where('user_id', auth()->user()->id)->count();

            if($pendiente) {
                $mensaje = "Usted tiene $pendiente ordenes pendientes. <a class='font-bold' href='".route('orders.index')."?status=PENDING'>Ir a pagar </a>";
                session()->flash('flash.banner', $mensaje);
            }
        }
        $categories = Category::all();

        $images = News::all();

        $products = Product::where('discount', '>', 0)
                    ->orWhereNotNull('discount')
                    ->get();

        return view('welcome2',compact('categories','images','products'));
    }
}
