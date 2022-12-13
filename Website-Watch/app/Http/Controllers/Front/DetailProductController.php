<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    public function detailProduct($id)
    {
        //get value product by id request
        $product = Product::find($id);
        //get name image from product retrieve
        $image = $product->productImage;
        //get a list of product image names
        $nameImages = $this->getFileImageProduct($image);
        //get brand slug
        $slugBrand = $this->getSlugBrand($product);
        //get gender slug
        $slugGender = $this->getSlugGender($product);
        if ($product)
            return view('product.detailProduct', compact('product', 'nameImages', 'slugBrand', 'slugGender'));
        else
            return Redirect('/');
    }
    public function getFileImageProduct($image)
    {
        $nameImage = [];
        for ($i = 0; $i < 6; $i++) {
            $get = 'image_' . ($i + 1);
            $nameImage[$i] = $image->$get;
        }
        return  $nameImage;
    }
    public function getSlugBrand($product)
    {
        return $product->productBrand['slug'];
    }
    public function getSlugGender($product)
    {
        return $product->productGender['slug'];
    }
}
