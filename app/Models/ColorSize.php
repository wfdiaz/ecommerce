<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = 'color_size';

        //uno a muchos inversa
        public function colors() {
            return $this->belongsTo(Color::class);
        }
    
        public function size() {
            return $this->belongsTo(Size::class);
        }
}
