<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function productBrand()
    {
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }
    public function productImage()
    {
        return $this->belongsTo(Image::class, 'image', 'id');
    }
    public function productGender()
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }
    public function productComment()
    {
        return $this->hasMany(Comment::class, 'product', 'id');
    }
    public function productOrderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'product', 'id');
    }
    public function maxID()
    {
        return DB::table('products')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
}
