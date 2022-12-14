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
    }
    public function addToCart(Request $request)
    {
        // get product by id
        $product = Product::find($request->id);
        // initialize session[cart]
        $cart = session()->get('cart', []);
        // price process when there is a discount
        $priceDiscount = $product->price - ($product->price * ($product->discount / 100));
        if (isset($cart[$request->id])) {
            // if price or discount of product changed then add new cart else update quantity
            if ($cart[$request->id]['price'] == $product->price && $cart[$request->id]['discount'] == $product->discount) {
                $cart[$request->id]['quantity']++;
                $cart[$request->id]['total'] = $priceDiscount + $cart[$request->id]['priceDiscount'];
            }
        } else {
            $cart[$request->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "discount" => $product->discount,
                "priceDiscount" => $priceDiscount,
                "image" => $product->productImage['image_1'],
                "total" => $priceDiscount
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
    public function updateQuantityCart(Request $request)
    {

        if ($request->action == "update-quantity") {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['total'] = $cart[$request->id]['priceDiscount'] * $request->quantity;
            session()->put('cart', $cart);
            return response()->json([
                'status' => 200,
                'msg' => 'Update quantity successfully',
            ]);
        }
        return response()->json([
            'status' => 500,
            'msg' => 'Update quantity errors',
        ]);
    }
    public function removeProductCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                //Check the cart if it's the LAST product in the cart, then delete the cart (else)
                if (count($cart) >= 2) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                } else {
                    $request->session()->forget('cart');
                    $request->session()->flush();
                }
            }
            // session()->flash('success', 'Product removed successfully');
        }
        return redirect('/gio-hang');
    }
    public function removeAllCart(Request $request)
    {
        if ($request->action = "Remove all cart") {
            $request->session()->forget('cart');
            $request->session()->flush();
            return response()->json([
                'status' => 200,
                'msg' => 'Remove successfully',
            ]);
        }
        return response()->json([
            'status' => 401,
            'msg' => 'Remove error',
        ]);
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
