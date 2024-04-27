<?php

namespace App\Http\Livewire\Admin;

use App\Models\FrequentlyQuestion;
use Livewire\Component;

class QuestionsComponent extends Component
{
    public $questions;
    public $rules = [
        'questions.*.question' => '',
        'questions.*.answer' => '',
        'questions.*.status' => '',
        'questions.*.order' => '',
    ];
    public function mount() {
        $this->questions = FrequentlyQuestion::orderby('order')->get();
    }
    public function render()
    {
        return view('livewire.admin.questions-component')->layout('layouts.admin');
    }

    public function new() {
        $question = new FrequentlyQuestion();
        $question->question ='Nueva Pregunta frecuente';
        $question->order = count($this->questions) + 1;
        $question->save();
        $this->questions = FrequentlyQuestion::orderby('order')->get();
    }

    public function updated($propertyName) {
        $explode = explode('.', $propertyName);
        if (count($explode) == 3) {
            if ($explode[0] == 'questions') {
                // dd($this->questions[$explode[1]]);
                
                $this->questions[$explode[1]]->save();

            //     if ($explode[2] == 'tipo') {
            //         $question->tipo = $this->questions[$explode[1]]['tipo'];
            //         if($this->questions[$explode[1]]['tipo'] == 'multiple'){
            //             $question->opciones = 'Opción 1||';
            //             $question->save();

            //             $this->validarPreguntas();
            //         } else{
            //             $question->opciones = null;
            //             $question->save();
            //             $this->validarPreguntas();
            //         }
            //     } elseif ($explode[2] == 'estado') {
            //         $question->estado = $this->questions[$explode[1]]['estado'];
            //     } elseif ($explode[2] == 'orden') {
            //         $anterior = $question->orden;
            //         $question->orden = $this->questions[$explode[1]]['orden'];
                    
            //         $change = Question::where('orden',$question->orden)->get()->first();
            //         $change->orden = $anterior;
            //         $change->save();
            //         $question->save();

            //         return redirect()->to(route('encuesta.preguntas'));

            //     } elseif ($explode[2] == 'pregunta') {
            //         $question->pregunta = trim($this->questions[$explode[1]]['pregunta']);
            //     }
            // } else {
            //     $question = Question::find($this->questions[$explode[1]]['id']);

            //     $question->opciones = '';
            //     foreach ($this->questionop[$explode[1]] as $op) {
            //         $question->opciones .= trim($op);
            //         $question->opciones .= '||';
            //     }
            // }

            // $question->save();
            }
        }
    }
}
