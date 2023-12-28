<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Category;
use App\Models\SubCategory;

class Navigation extends Component
{
    public $openc;

    public function render()
    {
        if($this->openc) {
            $cate = Category::find($this->openc);
            $subcategories = $cate->subcategories;
        } else {
            $cate = "";
            $subcategories = [];
        }

        $categories = Category::all();  

        return view('livewire.navigation', compact('categories', 'subcategories', 'cate'));
    }
}
