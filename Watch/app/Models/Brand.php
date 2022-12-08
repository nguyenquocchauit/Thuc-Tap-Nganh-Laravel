<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
     protected $primaryKey = false;
    // protected $guarded = [];

    // public function product(){
    //     return $this->hasMany(Product::class,'brand','id');
    // }

}
