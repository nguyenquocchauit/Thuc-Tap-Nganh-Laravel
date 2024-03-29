<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gender;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();
        //Get products
        $perPage = $request->show ?? 6;
        $sortBy = $request->sort_by ?? 'latest';
        //Get min,max price
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        $products = Product::where('name', 'like', '%%');
        $products = $this->gender($products, $request);
        $products = $this->filter($products, $request);
        $products = $this->sortAndPagination($products, $sortBy, $perPage);
        return view('product.shop', compact('brands', 'products', 'min_price', 'max_price'));
    }
    public function gender($products, Request $request)
    {
        //Gender
        $genders = $request->gender ?? [];
        $gender_ids = array_map(function ($gender) {
            return $gender == 'nam' ? 1 : 2;
        }, array_keys($genders));
        $products = $gender_ids != null ? $products->whereIn('gender', $gender_ids) : $products;

        return $products;
    }
    public function sortAndPagination($products, $sortBy, $perPage)
    {
        switch ($sortBy) {
            case 'latest':
                $products = $products->orderBy('name');
                break;
            case  'oldest':
                $products = $products->orderByDesc('id');
                break;
            case  'name-ascending':
                $products = $products->orderBy('name');
                break;
            case  'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case  'price-ascending':
                $products = $products->orderByRaw('ROUND(price - (price * (discount/100)), 1)');
                break;
            case  'price-descending':
                $products = $products->orderByRaw('ROUND(price - (price * (discount/100)), 1) DESC');
                break;
            default:
                $products = $products->orderBy('id');
        }
        $products = $products->paginate($perPage);

        $products->appends(['sort_by' => $sortBy, 'show' => $perPage]);
        return $products;
    }

    public function filter($products, Request $request)
    {
        //Brand
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = $brand_ids != null ? $products->whereIn('brand', $brand_ids) : $products;

        //Price
        $priceMin = $request->start_price;
        $priceMax = $request->end_price;
        if ($priceMin != null && $priceMax != null) {
            $products = $products->whereBetween(DB::raw('ROUND(price - (price * (discount/100)), 1)'), [$priceMin, $priceMax]);
        }
        return $products;
    }
}
