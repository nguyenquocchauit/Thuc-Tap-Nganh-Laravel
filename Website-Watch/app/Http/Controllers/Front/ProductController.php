<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikeProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

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
                'status' => 422,
                'msg' => 'No products found',
            ]);
        }
    }

    public function detailProduct(Request $request)
    {

        //get value product by id request
        $product = Product::find($request->id);
        if ($product) {
            //get name image from product retrieve
            $image = $product->productImage;
            //get brand slug
            $slugBrand = $this->getSlugBrand($product);
            //get comment of product
            $comments = $this->commentOfProduct($request->id);
            //read gender value infer slug when taking photo
            $slugGender = $product->gender;
            if ($slugGender == 1)
                $slugGender = "men";
            if ($slugGender == 2)
                $slugGender = "women";
            return view('product.detailProduct', compact('product', 'slugBrand', 'slugGender', 'comments'));
        } else
            return Redirect('/');
    }

    public function commentOfProduct($product)
    {
        // get all comment of product
        $comment = Comment::query()
            ->where('product', $product)
            ->orderByDesc('created_at')
            ->get();
        return $comment;
    }

    public function writeComment(Request $request)
    {
        $check = Order::join('order_details', 'order_details.orders', '=', 'orders.id')
            ->where('order_details.product', $request->product)
            ->where('orders.customers', $request->user)
            ->where('orders.status', "TC")
            ->exists();
        if ($check == false) {
            return response()->json([
                'status' => 422,
                'msg' => 'Have not bought yet',
            ]);
        } else {
            if ($request->action == "Write comment product") {
                $content = null;
                if (empty($request->textComment)) {
                    $content = "";
                } else {
                    $content = $request->textComment;
                }
                $comment = new Comment();
                $comment->id  = "cm" . (Comment::count() + 1) . now()->setTimezone('Asia/Ho_Chi_Minh')->format('dmY');
                $comment->customers  = $request->user;
                $comment->product  = $request->product;
                $comment->content = $content;
                $comment->star = $request->rating;
                $comment->created_at = now()->setTimezone('Asia/Ho_Chi_Minh');
                $comment->save();
                $name = User::find($request->user);
                return response()->json([
                    'status' => 200,
                    'msg' => 'Write comment successfully',
                    'id' => "cm" . (Comment::count()) . now()->setTimezone('Asia/Ho_Chi_Minh')->format('dmY'),
                    'data' =>  [
                        'star' => $request->rating,
                        'created_at' => now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y'),
                        'content' => $content,
                    ],
                    'author' => $name,
                ]);
            } else
                return response()->json([
                    'status' => 500,
                    'msg' => 'Write comment error',
                ]);
        }
    }
    public function deleteComment(Request $request)
    {
        if ($request->action == "Delete comment product") {
            $comment = Comment::find($request->IDComment);
            if ($comment != null) {
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete comment successfully',
                ]);
            } else {
                if ($comment == null) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Delete comment error',
                    ]);
                }
            }
        } else
            return response()->json([
                'status' => 500,
                'msg' => 'Delete comment error',
            ]);
    }


    public function likeProduct(Request $request)
    {
        if ($request->action == "Like product") {
            $like = LikeProduct::where('customers', $request->user)->where('product', $request->product)->get();
            // >0 is customer have been liked product , else none like product
            if (count($like) > 0) {
                if ($like[0]->status == 'like') {
                    LikeProduct::where('id', $like[0]->id)->update(array(
                        'status' => 'none',
                    ));
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Unlike product successfully',
                        'data' => $like,
                    ]);
                } else {
                    if ($like[0]->status == 'none') {
                        LikeProduct::where('id', $like[0]->id)->update(array(
                            'status' => 'like',
                        ));
                        return response()->json([
                            'status' => 200,
                            'msg' => 'Like product successfully',
                            'data' =>  $like[0]->products,
                            'image' => $like[0]->products->productImage['image_1'],
                        ]);
                    }
                }
            } else {

                $like = new likeProduct();
                $like->id  = "like" . (LikeProduct::count() + 1) . now()->setTimezone('Asia/Ho_Chi_Minh')->format('dmY');
                $like->customers = $request->user;
                $like->product = $request->product;
                $like->status = 'like';
                $like->created_at = now()->setTimezone('Asia/Ho_Chi_Minh');
                $like->save();
                return response()->json([
                    'status' => 200,
                    'msg' => 'Like product successfully',
                    'data' =>  $like->products,
                    'image' => $like->products->productImage['image_1'],
                ]);
            }
        } else
            return response()->json([
                'status' => 500,
                'msg' => 'Like comment error',
            ]);
    }
    public function removeLikeProduct(Request $request)
    {
        if ($request->action == "Clear like product") {
            $liked = LikeProduct::query()
                ->where('customers', $request->user)
                ->where('status', '=', 'like')
                ->selectRaw('likes.product')
                ->get();
            LikeProduct::where('customers', $request->user)->update(array(
                'status' => 'none',
            ));

            return response()->json([
                'status' => 200,
                'msg' => 'Clear like successfully',
                'product' => $liked,
            ]);
        }
    }



    public function getSlugBrand($product)
    {
        return $product->productBrand['slug'];
    }
}
