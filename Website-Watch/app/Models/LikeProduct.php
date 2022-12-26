<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function maxID()
    {
        return DB::table('likes')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
}
