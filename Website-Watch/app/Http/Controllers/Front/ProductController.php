<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function searchProduct($search)
    {
        // get product by parameter $search
        $data = Product::where('name', 'like', "$search%")->get();
        if (count($data) > 0) {
            return response()->json([
                'status' => 200,
                'msg' => 'successful product found',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'msg' => 'No products found',
                'data' => $data,
            ]);
        }
    }

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
        //get comment of product
        $comments = $this->commentOfProduct($id);
        if ($product)
            return view('product.detailProduct', compact('product', 'nameImages', 'slugBrand', 'slugGender', 'comments'));
        else
            return Redirect('/');
    }
    public function commentOfProduct($product)
    {
        // get all comment of product
        $comment = Comment::where('product', $product)->get();
        return $comment;
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
