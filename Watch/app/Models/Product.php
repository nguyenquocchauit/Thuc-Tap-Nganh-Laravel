<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }
    public function image()
    {
        return $this->hasOne(Image::class, 'image', 'id');
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'product', 'id');
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'product', 'id');
    }
}
