<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\SubCategory;

class ProductObserver
{
    public function updated(Product $product) {
        $subcategory_id = $product->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);

        if ($subcategory->size) {
            if ($product->colors->count()) {
                $product->colors()->detach();
            }
        } elseif ($subcategory->color) {
            if ($product->sizes->count()) {
                foreach ($product->sizes as $key => $size) {
                    $size->delete();
                }
            }
        } else {
            if ($product->colors->count()) {
                $product->colors()->detach();
            }

            if ($product->sizes->count()) {
                foreach ($product->sizes as $key => $size) {
                    $size->delete();
                }
            }
        }
    }
}
