<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gender extends Model
{
    use HasFactory;

    protected $table = "gender";
    protected $primaryKey = "id";
    // protected $guarded = [];
    public $timestamps = FALSE;
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public function products(){
        return $this->hasMany(Product::class,'gender','id');
    }
    public function maxID()
    {
        return DB::table('gender')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
    public function getAllCategories($search = null) {
        $categories = Gender::first('id');
        if(!empty($search)) {
            $categories = $categories->where(function($query) use ($search) {
                $query->orWhere('name','like','%'.$search.'%');
            });
        }
        $categories = $categories->paginate(10);
        return $categories;
    }
}
