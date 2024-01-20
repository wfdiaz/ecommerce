<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $brands, $categories, $category, $rand;

    protected $listeners = ['delete'];

    public $createForm = [
        'name' => null,
        'slug' => null,
        'image' => null,
        'discount' => null,
        'discount_date' => null,
        'brands' => [],
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'image' => null,
        'discount' => null,
        'discount_date' => null,
        'brands' => [],
    ];

    public $editImage;

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug',
        'createForm.image' => 'required|image|max:1024',
        'createForm.discount' => '',
        'createForm.discount_date' => '',
        'createForm.brands' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.image' => 'imagen',
        'createForm.brands' => 'marcas',
        'createForm.discount' => 'descuento',
        'createForm.discount_date' => 'fecha fin descuento',
        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',
        'editImage' => 'imagen',
        'editForm.brands' => 'marcas',
        'editForm.discount' => 'descuento',
        'editForm.discount_date' => 'fecha fin descuento'
    ];

    public function mount(){
        $this->getBrands();
        $this->getCategories();
        $this->rand = rand();
    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value){
        $this->editForm['slug'] = Str::slug($value);
    }

    public function getBrands(){
        $this->brands = Brand::all();
    }

    public function getCategories(){
        $this->categories = Category::all();
    }

    public function save(){
        $rules = $this->rules;
        if ($this->createForm['discount']) {
            $rules['createForm.discount'] = 'required|numeric|min:1|max:90';
            $rules['createForm.discount_date'] = 'required|date|after:today';
        }
        
        $this->validate($rules);

        $image = $this->createForm['image']->store('public/categories');

        $category = Category::create([
            'name' => $this->createForm['name'],
            'slug' => $this->createForm['slug'],
            'image' => $image,
            'discount' => $this->createForm['discount'],
            'discount_date' => $this->createForm['discount_date'],
        ]);

        $category->brands()->attach($this->createForm['brands']);

        $this->rand = rand();
        $this->reset('createForm');

        $this->getCategories();
        $this->emit('saved');
    }

    public function edit(Category $category){

        $this->reset(['editImage']);
        $this->resetValidation();

        $this->category = $category;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $category->name;
        $this->editForm['slug'] = $category->slug;
        $this->editForm['discount'] = $category->discount;
        $this->editForm['discount_date'] = $category->discount_date;
        $this->editForm['image'] = $category->image;
        $this->editForm['brands'] = $category->brands->pluck('id');
    }

    public function update(){

        $rules = [
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:categories,slug,' . $this->category->id,
            'editForm.brands' => 'required',
            'editForm.discount' => '',
            'editForm.discount_date' => '',
        ];
        if ($this->editForm['discount']) {
            $rules['editForm.discount'] = 'required|numeric|min:1|max:90';
            $rules['editForm.discount_date'] = 'required|date|after:today';
        }
        if ($this->editImage) {
            $rules['editImage'] = 'required|image|max:1024';
        }

        $this->validate($rules);

        if ($this->editImage) {
            Storage::delete($this->editForm['image']);
            $this->editForm['image'] = $this->editImage->store('public/categories');
        }

        $this->category->update($this->editForm);

        $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getCategories();
    }

    public function delete(Category $category){
        $category->delete();
        $this->getCategories();
    }
}
