<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // relacion uno a muchos
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
