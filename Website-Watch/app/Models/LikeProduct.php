<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeProduct extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'customers', 'id');
    }
}