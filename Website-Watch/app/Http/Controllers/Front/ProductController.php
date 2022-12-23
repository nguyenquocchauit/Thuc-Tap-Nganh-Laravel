<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikeProduct;
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
                'status' => 200,
                'msg' => 'No products found',
                'data' => $data,
            ]);
        }
    }

    public function detailProduct(Request $request)
    {

        //get value product by id request
        $product = Product::find($request->id);
        //get name image from product retrieve
        $image = $product->productImage;
        //get a list of product image names
        $nameImages = $this->getFileImageProduct($image);
        //get brand slug
        $slugBrand = $this->getSlugBrand($product);
        //get gender slug
        $slugGender = $this->getSlugGender($product);
        //get comment of product
        $comments = $this->commentOfProduct($request->id);
        if ($product)
            return view('product.detailProduct', compact('product', 'nameImages', 'slugBrand', 'slugGender', 'comments'));
        else
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
        if ($request->action == "Write comment product") {
            // get time now
            $currentTime = Carbon::now();
            // get max id
            $maxID = Comment::query()
                ->selectRaw('MAX(id) AS ID_Max')
                ->get();
            // get max id from object maxID
            $ID = $maxID[0]['ID_Max'];
            $ID = (int)$ID  + 1;
            $comment = new Comment();
            $comment->id  = $ID;
            $comment->customers  = $request->user;
            $comment->product  = $request->product;
            $comment->content = $request->textComment;
            $comment->star = $request->rating;
            $comment->created_at = $currentTime->toDateTimeString();
            $comment->save();
            $name = User::find($request->user);
            return response()->json([
                'status' => 200,
                'msg' => 'Write comment successfully',
                'data' =>  $comment,
                'author' => $name,
            ]);
        } else
            return response()->json([
                'status' => 500,
                'msg' => 'Write comment error',
            ]);
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
                // get time now
                $currentTime = Carbon::now();
                // get max id
                $maxID = likeProduct::query()
                    ->selectRaw('MAX(id) AS ID_Max')
                    ->get();
                // get max id from object maxID
                $ID = $maxID[0]['ID_Max'];
                $ID = (int)$ID  + 1;
                $like = new likeProduct();
                $like->id  = $ID;
                $like->customers = $request->user;
                $like->product = $request->product;
                $like->status = 'like';
                $like->created_at = $currentTime->toDateTimeString();
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
                ->where('status', '=','like')
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
