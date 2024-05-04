<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditProduct extends Component
{
    public $product, $categories, $subcategories, $brands, $slug;

    public $category_id;

    protected $rules = [
        'category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.name' => 'required',
        'slug' => 'required|unique:products,slug',
        'product.description' => 'required',
        'product.brand_id' => 'required',
        'product.price' => 'required',
        'product.quantity' => '',
        'product.discount' => '',
        'product.discount_date' => '',
        'product.order' => '',
    ];

    protected $listeners = ['refreshProduct', 'delete'];

    public function mount(Product $product){
        $this->product = $product;

        $this->categories = Category::all();

        $this->category_id = $product->subcategory->category->id;

        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();

        $this->slug = $this->product->slug;

        $this->brands = Brand::whereHas('categories', function(Builder $query){
            $query->where('category_id', $this->category_id);
        })->get();
    }

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }

    public function refreshProduct(){
        $this->product = $this->product->fresh();
    }

    public function updatedProductName($value){
        $this->slug = Str::slug($value);
    }

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();

        $this->product->subcategory_id = "";
        $this->product->brand_id = "";
    }

    public function getSubcategoryProperty(){
        return Subcategory::find($this->product->subcategory_id);
    }

    public function save(){
        $rules = $this->rules;

         // Agregar regla de validación para el slug único, excepto para el producto actual
        $slugCount = Product::where('slug', $this->slug)->count();
        if ($slugCount > 0) {
            $this->slug = $this->slug . $slugCount;
        } else {
            $this->slug = $this->slug;
        }

        $rules['slug'] = 'required|unique:products,slug,' . $this->product->id;

         // Validar cantidad si la subcategoría no tiene color ni tamaño
        if ($this->product->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) {
                $rules['product.quantity'] = 'required|numeric';
            }
        }

        // Validar descuento si está presente
        if($this->product->discount) {
            $rules['product.discount'] = 'required|numeric|min:1|max:90';
            $rules['product.discount_date'] = 'required|date|after:today';
        }

        $this->validate($rules);

        // Verificar si el nuevo orden ya está ocupado por otro producto
        $productoConOrdenExistente = Product::where('order', $this->product->order)
            ->where('id', '!=', $this->product->id)
            ->first();

            if ($productoConOrdenExistente) {
                // Intercambiar los órdenes
                $ordenTemporal = $productoConOrdenExistente->order;

                $prod = Product::find($this->product->id);
                $productoConOrdenExistente->order = $prod->order;  // Asignar al otro producto el orden actual del producto editado
        
                // Guardar los cambios del producto existente
                $productoConOrdenExistente->save();
        
                // Asignar al producto editado el orden que tenía el otro producto
                $this->product->order = $ordenTemporal;
            }
    
        $this->product->slug = $this->slug;

        $this->product->save();

        $this->emit('alert', 'Guardo correctamente');

        $this->emit('saved');
    }

    public function deleteImage(Image $image){
        Storage::delete([$image->url]);
        $image->delete();

        $this->product = $this->product->fresh();
    }

    public function delete(){

        $images = $this->product->images;

        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }

        $this->product->delete();

        return redirect()->route('admin.index');

    }
}
