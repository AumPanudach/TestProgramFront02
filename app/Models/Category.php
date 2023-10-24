<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
