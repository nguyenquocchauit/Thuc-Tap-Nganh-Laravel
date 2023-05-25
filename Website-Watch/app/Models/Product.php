<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;

    public function productBrand()
    {
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }
    public function productImage()
    {
        return $this->belongsTo(Image::class, 'image', 'id');
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
    public function currentTime()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        return $currentTime->toDateTimeString();
    }
    public function checkGender($gender)
    {
        if ($gender == 1)
            return  "men";
        if ($gender == 2)
            return  "women";
    }

    public function getAllProducts($filters = [], $search = null, $sortbyArr = null)
    {
        $products = Product::first('id')
            ->select('products.*', 'gender as gender_name');
        $orderBy = 'id';
        $orderType = 'asc';
        if (!empty($sortbyArr) && is_array($sortbyArr)) {
            if (!empty($sortbyArr['sortBy']) && !empty($sortbyArr['sortType'])) {
                $orderBy = trim($sortbyArr['sortBy']);
                $orderType = trim($sortbyArr['sortType']);
            }
        }
        $products = $products->orderBy($orderBy, $orderType);

        if (!empty($filters)) {
            $products->where($filters);
        }

        if (!empty($search)) {
            $products = $products->where(function ($query) use ($search) {
                $query->orWhere('products.name', 'like', '%' . $search . '%');
            });
        }
        $products = $products->paginate(10);
        return $products;
    }
}
