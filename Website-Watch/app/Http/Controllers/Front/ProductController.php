<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function searchProduct($search)
    {
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

    public function cart()
    {
        return view('product.cart');
        // $cart = session()->get('cart');
        // if (isset($cart))
        //     return view('product.cart');
        // return redirect('/');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // price processing when there is a discount
        $priceDiscount = $product->price - ($product->price * ($product->discount / 100));
        if (isset($cart[$id])) {
            // if price or discount of product changed then add new cart else update quantity
            if ($cart[$id]['price'] == $product->price && $cart[$id]['discount'] == $product->discount) {
                $cart[$id]['quantity']++;
                $cart[$id]['priceDiscount'] = $priceDiscount + $cart[$id]['priceDiscount'];
            }
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "discount" => $product->discount,
                "priceDiscount" => $priceDiscount,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return response()->json([
            'status' => 200,
            'msg' => 'Add to cart succes',
            'quantity_cart' => count($cart),
            'cart' => $cart,
        ]);
    }
    public function removeProductCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function removeAllCart(Request $request)
    {
        if ($request->action = "Remove all cart") {
            $request->session()->forget('cart');
            return response()->json([
                'status' => 200,
                'msg' => 'Remove successfully',
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
