<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart()
    {
        // add estimated delivery time (+3 days from current date)
        $time = new Product();
        $time = $time->currentTime();
        return view('product.cart', compact('time'));
    }
    public function addToCart(Request $request)
    {
        // get product by id
        $product = Product::find($request->id);
        //display product type (gender)
        $gender = $product->gender;
        if ($gender == 1)
            $gender = "Nam";
        if ($gender == 2)
            $gender = "Nữ";
        // initialize session[cart]
        $cart = session()->get('cart', []);
        // price process when there is a discount
        $priceDiscount = $product->price - ($product->price * ($product->discount / 100));
        if (isset($cart[$request->id])) {
            // nếu số lượng trong kho đã hết thì thông báo
            $current_quantity = DB::table('products')
                ->select('quantity')
                ->where('id', $request->id)
                ->first();
            $current_quantity_cart = $cart[$request->id]['quantity'] + $cart[$request->id]['quantity'];
            if ($current_quantity_cart > $current_quantity->quantity) {
                return response()->json([
                    'status' => 422,
                    'msg' => 'Out of stock',
                ]);
            } else {
                // check if quantity of id >5 then break
                if ($cart[$request->id]['quantity'] >= 5) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Passed the number above 5',
                        'quantity_cart' => count($cart),
                        'cart' => $cart,
                    ]);
                } else {
                    // if price or discount of product changed then add new cart else update quantity
                    if ($cart[$request->id]['price'] == $product->price && $cart[$request->id]['discount'] == $product->discount) {
                        $cart[$request->id]['quantity']++;
                        $cart[$request->id]['total'] = $priceDiscount + $cart[$request->id]['priceDiscount'];
                    }
                }
            }
        } else {
            // nếu số lượng trong kho đã hết thì thông báo
            $current_quantity = DB::table('products')
                ->select('quantity')
                ->where('id', $request->id)
                ->first();
            if ($current_quantity->quantity <= 0) {
                return response()->json([
                    'status' => 422,
                    'msg' => 'Out of stock',
                ]);
            } else {
                $cart[$request->id] = [
                    "name" => $product->name,
                    "brand" => $product->productBrand['name'],
                    "gender" => $gender,
                    "quantity" => 1,
                    "price" => $product->price,
                    "discount" => $product->discount,
                    "priceDiscount" => $priceDiscount,
                    "image" => $product->image_1,
                    "total" => $priceDiscount
                ];
            }
        }

        session()->put('cart', $cart);
        return response()->json([
            'status' => 200,
            'msg' => 'Add to cart successfully',
            'quantity_cart' => count($cart),
            'cart' => $cart,
        ]);
    }
    public function updateQuantityCart(Request $request)
    {

        if ($request->action == "update-quantity") {
            $cart = session()->get('cart');
            $current_quantity = DB::table('products')
                ->select('quantity')
                ->where('id', $request->id)
                ->first();
            if ($request->quantity > $current_quantity->quantity) {
                return response()->json([
                    'status' => 422,
                    'msg' => 'Out of stock',
                    'data' => $cart[$request->id]['quantity'],
                    "data2" => $request->quantity
                ]);
            } else {
                $cart[$request->id]['quantity'] = $request->quantity;
                $cart[$request->id]['total'] = $cart[$request->id]['priceDiscount'] * $request->quantity;
                session()->put('cart', $cart);
                return response()->json([
                    'status' => 200,
                    'msg' => 'Update quantity successfully',
                ]);
            }
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
                    //$request->session()->flush();
                }
            }
            // session()->flash('success', 'Product removed successfully');
        }
        return redirect('/gio-hang');
    }
    public function removeAllCart(Request $request)
    {
        if ($request->action == "Remove all cart") {
            $request->session()->forget('cart');
            // $request->session()->flush();
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
}
