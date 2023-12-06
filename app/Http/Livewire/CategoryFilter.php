<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $subcategoria, $marca;
    public $view = 'grid';

    protected $queryString = ['subcategoria', 'marca'];

    public function render() {
        // $products = $this->category->products()->where('status', 2)->paginate(20);

        $productsQuery = Product::query()->wherehas('subcategory.category', function(Builder $query){
            $query->where('id',$this->category->id);
        });

        if($this->subcategoria) {
            $productsQuery = $productsQuery->wherehas('subcategory', function(Builder $query){
                $query->where('slug', $this->subcategoria);
            });
        }

        if($this->marca) {
            $productsQuery = $productsQuery->wherehas('brand', function(Builder $query){
                $query->where('name', $this->marca);
            });
        }

        $products = $productsQuery->paginate((20));
        return view('livewire.category-filter', compact('products'));
    }

    public function limpiar() {
        $this->reset(['subcategoria', 'marca', 'page']);
    }

    public function updatedSubcategory(){
        $this->resetPage();
    }

    public function updatedMarca(){
        $this->resetPage();
    }
}
