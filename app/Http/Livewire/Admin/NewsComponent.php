<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;
use Livewire\WithPagination;
use App\Http\Traits\OrderTableTrait;
use App\Models\News;

class NewsComponent extends Component
{
    use WithPagination;
    use OrderTableTrait;
    use WithFileUploads;

    public $bandera = false;
    public $modal = false;
    public $title, $ruta, $active, $id_new;

    public $search;

    protected $listeners = ['customerSave' => 'customerSave'];

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];
    public function updating($name, $value)
    {
        if (($name == "search") || ($name == "camp") || ($name == "order")) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.news-component',[
            'news' => News::orderBy($this->camp, $this->order)
            ->where('title', 'LIKE','%' .$this->search.'%')
            ->paginate(5),
        ])->layout('layouts.admin');;
    }

    public function New()
    {
        $this->title = "";
        $this->ruta = null;
        $this->active = "si";

        $this->modal = true;
        $this->bandera = true;
    }

    public function Edit($new_id)
    {
        $this->id_new = $new_id;
        $this->modal = true;

        $new =  News::find($new_id);
        $this->title = $new->title;
        $this->active = $new->active;
        // $this->ruta = $new->ruta;
    }

    public function ExitNew(){
        $this->modal = false;
        $this->bandera = false;
    }

    public function SaveNew(){

        if(is_null($this->active)){
            $this->active = "si";
        }

        if($this->bandera == true){

            $nombre = $this->ruta->getClientOriginalName();
            $ruta = $this->ruta->storeAs('public/images', $nombre);
            // $ruta = $this->ruta->store('public/images');
            
            $new = new News;
            $new->title = $this->title;
            $new->ruta = $ruta;
            $new->active = $this->active;
            $new->save();

            $this->emit('alert', 'Guardo Correctamente');

            $this->title = "";
            // $this->ruta = "";
            $this->active = "si";
            $this->modal = false;

        }else{

            $new =  News::find($this->id_new);
            if(is_null($this->ruta)){
                // $this->ruta = $new->ruta;
                $new->ruta = $new->ruta;
            }else{
                $nombre = $this->ruta->getClientOriginalName();
                $rutaImagen = public_path('images/'. $nombre);
                
                $ruta = $this->ruta->storeAs('public/images', $nombre);
                $new->ruta = $ruta;
            }
            // if(Storage::exists($new->ruta)){
            //     $new->ruta = $new->ruta;
            // }else{
            // }

            $new->title = $this->title;
            $new->active = $this->active;
            $new->save();

            $this->title = "";
            // $this->ruta = "";
            $this->active = "si";
            $this->modal = false;

            $this->emit('alert', 'Actualizo Correctamente');
        }
        
    }

    public function delete(News $id){
        $id->delete();
        $this->emit('alert', 'Eliminado Correctamente');
    }
}
