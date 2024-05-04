<?php

namespace App\Http\Livewire;

use App\Models\FrequentlyQuestion;
use Livewire\Component;

class Footer extends Component
{
    public $questions;

    public function mount() {
        $this->questions = FrequentlyQuestion::where('status', "1")->count();
        // dd($this->questions);
    }
    public function render()
    {
        return view('livewire.footer');
    }
}
