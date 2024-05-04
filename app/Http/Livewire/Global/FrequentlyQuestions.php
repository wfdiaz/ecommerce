<?php

namespace App\Http\Livewire;

use App\Models\FrequentlyQuestion;
use Livewire\Component;

class FrequentlyQuestions extends Component
{
    public $questions;

    public function mount() {
        $this->questions = FrequentlyQuestion::where('status', "1")->orderby('order')->get();
        // dd($this->questions);
    }

    public function render()
    {
        return view('livewire.global.frequently-questions');
    }
}
