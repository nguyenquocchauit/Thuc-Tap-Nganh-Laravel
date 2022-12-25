<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    // protected $primaryKey = false;
    protected $primaryKey = false;
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = FALSE;
    // protected $guarded = [];
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'brand', 'id');
    }
    public function maxID()
    {
        return DB::table('users')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
    public function getAllBrands($search = null) { 
        $brands = Brand::first('id');
        if(!empty($search)) {
            $brands = $brands->where(function($query) use ($search) {
                $query->orWhere('name','like','%'.$search.'%');
            });
        }
        $brands = $brands->paginate(10);
        return $brands;
    }
}
