<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product) {
        $request->validate([
            'comment' => 'required|min:5',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $product->reviews()->create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        session()->flash('flash.banner', 'Tu reseña se agrego con éxito');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();
    }
}
