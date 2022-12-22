<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách sản phẩm';

        $products = Product::first('id')->paginate(10);
        return view('admin.product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get list of brand and gender
        $brands = Brand::get();
        $genders = Gender::get();
        $title = 'Thêm sản phẩm';
        return view('admin.product.create', compact('title', 'brands', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name_product = strtolower($request->name_product);
        $name_product = explode(" ", $name_product);
        $name_product = implode("-", $name_product);
        $image = Image::where("id", "=", $name_product)->get();
        if (count($image) > 0) {
            $name_product =  $name_product . "-v2";
        }
        $dataImage = [
            "id" => $name_product,
            "image_1" => $name_product . "-1.png",
            "image_2" => $name_product . "-2.png",
            "image_3" => $name_product . "-3.png",
            "image_4" => $name_product . "-4.png",
            "image_5" => $name_product . "-5.png",
            "image_6" => $name_product . "-6.png",

        ];
        return response()->json($dataImage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Chi tiết sản phẩm';
        return view('admin.product.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Cập nhật sản phẩm';
        return view('admin.product.edit', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
