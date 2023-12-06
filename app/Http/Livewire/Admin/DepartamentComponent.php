<?php

namespace App\Http\Livewire\Admin;

use App\Models\Departament;
use Livewire\Component;

class DepartamentComponent extends Component
{
    public $departments, $department;

    protected $listeners = ['delete'];

    public $createForm = [
        'name' => ''
    ];

    public $editForm = [
        'open' => false,
        'name' => ''
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre'
    ];

    public function mount(){
        $this->getDepartments();
    }

    public function render()
    {
        return view('livewire.admin.departament-component')->layout('layouts.admin');
    }

    public function getDepartments(){
        $this->departments = Departament::all();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required'
        ]);

        Departament::create($this->createForm);

        $this->reset('createForm');

        $this->getDepartments();

        $this->emit('saved');
    }

    public function edit(Departament $department){
        $this->department = $department;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $department->name;
    }

    public function update(){
        $this->department->name = $this->editForm['name'];
        $this->department->save();

        $this->reset('editForm');
        $this->getDepartments();
    }


    public function delete(Departament $department){
        $department->delete();
        $this->getDepartments();
    }
}
