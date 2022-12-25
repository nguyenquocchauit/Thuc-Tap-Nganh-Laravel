<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    public function store(ProductRequest $request)
    {
        /** Kiểm tra tất cả dữ liệu đầu vào của $request
         * Required tất cả dữ liệu bắt buộc phải nhập
         * Image 6 ảnh chỉ chấp nhận 3 loại file: png, jpg, webp
         */
    

        $name = $request->name_product;
        $id_image = strtolower($name);
        $id_image = explode(" ", $id_image);
        $id_image = implode("-", $id_image);
        $image = Image::where("id", "=", $id_image)->get();
        //delete Vietnamese with accents
        $id_image = $this->stripVN($id_image);
        // check if name product (is a mean id image) existed then id of table image add other "v2"
        if (count($image) > 0) {
            $id_image =  $id_image . "-v2";
        }

        // insert data of image
        $image_1 = $id_image . "-1.png";
        $image_2 = $id_image . "-2.png";
        $image_3 = $id_image . "-3.png";
        $image_4 = $id_image . "-4.png";
        $image_5 = $id_image . "-5.png";
        $image_6 = $id_image . "-6.png";
        $dataImage = [
            "id" => $id_image,
            "image_1" => $image_1,
            "image_2" => $image_2,
            "image_3" => $image_3,
            "image_4" => $image_4,
            "image_5" => $image_5,
            "image_6" => $image_6,
        ];
        // add data to table image
        Image::insert($dataImage);
        // get max id from table product
        $product = new Product();
        $maxID = $product->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;
        // processing to remove VNĐ and commas
        $price = explode(" ", $request->price_product);
        $price = explode(",", $price[0]);
        $price = implode("", $price);
        // processing to remove %
        $discount = explode("%", $request->discount_product);
        // insert data of product
        $dataProduct = [
            "id" => $maxID,
            "name" => $request->name_product,
            "image" => $id_image,
            "description" => $request->description_product,
            "quantity" => $request->quantity_product,
            "price" => $price,
            "discount" => $discount[0],
            "gender" => $request->product_category_id,
            "brand" => $request->brand_id,
            "create_at" => $product->currentTime(),
            "updated_at" => $product->currentTime(),
        ];

        // add data to table product
        Product::insert($dataProduct);

        // processing move file image to public image
        $file = [$request->image_1, $request->image_2, $request->image_3, $request->image_4, $request->image_5, $request->image_6];
        $nameImage = [$image_1, $image_2, $image_3, $image_4, $image_5, $image_6];
        $this->moveImageProduct($request->brand_id, $request->product_category_id, $file, $nameImage);
        return redirect('admin/product')->with('success', 'Thêm sản phẩm thành công');
    }
    public function moveImageProduct($brand, $gender, $file, $name)
    {
        // get slug path gender and brand for product
        $slugBrand = Brand::query()
            ->where("id",  $brand,)
            ->get();
        $slugGender = Gender::query()
            ->where("id",  $gender)
            ->get();
        // add image for list image of product
        $destinationPath = 'images/images-product' . "/" . $slugGender[0]->slug . "/" . $slugBrand[0]->slug . "/";
        for ($i = 0; $i < count($file); $i++) {
            $file[$i]->move(public_path($destinationPath), $name[$i]);
        }
        //add image preview of font web such as: page hom, shop, cart,...
        $filecpy = $destinationPath . $name[0];
        $destinationPathHome = 'images/image_products_home/' . $name[0];
        File::copy(public_path($filecpy), public_path($destinationPathHome));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $title = 'Chi tiết sản phẩm';
        return view('admin.product.show', compact('title','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            $brands = Brand::get();
            $genders = Gender::get();
            $title = 'Cập nhật sản phẩm';
            return view('admin.product.edit', compact('title', 'product', 'brands', 'genders'));
        } else {
            return redirect('/admin/product');
        }
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
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect('/admin/product')->with('success', 'Xóa sản phẩm thành công');
    }

    public function stripVN($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
}
