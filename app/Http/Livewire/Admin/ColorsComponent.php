<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;

class ColorsComponent extends Component
{
    public $colors, $color;

    public $createForm = [
        'name' => ''
    ];

    public $editForm = [
        'open' => false,
        'name' => ''
    ];

    protected $validationAttributes = [
        'createForm.name' => 'color'
    ];

    public function mount(){
        $this->getColors();
    }

    public function render()
    {
        return view('livewire.admin.colors-component')->layout('layouts.admin');
    }

    public function getColors(){
        $this->colors = Color::all();
        // dd($this->colors);
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required'
        ]);

        Color::create($this->createForm);

        $this->reset('createForm');

        $this->getColors();

        $this->emit('saved');
    }

    public function edit(Color $color){
        $this->color = $color;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $color->name;
    }

    public function update(){
        $this->color->name = $this->editForm['name'];
        $this->color->save();

        $this->reset('editForm');
        $this->getColors();
    }
}
