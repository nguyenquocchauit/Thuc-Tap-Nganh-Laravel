<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $products;
    public function __construct()
    {
        $this->products = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Danh sách sản phẩm';
        //filter brand, categories,
        $filters = [];
        $search = null;
        if (!empty($request->category)) {
            $category = $request->category;
            $filters[] = ['products.gender', '=', $category];
        }
        if (!empty($request->brand)) {
            $brand = $request->brand;
            $filters[] = ['products.brand', '=', $brand];
        }

        //search name products

        if (!empty($request->search)) {
            $search = $request->search;
        }

        //Sort price,discount and quantity
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');

        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = $this->products->getAllProducts($filters, $search, $sortArr);


        return view('admin.product.index', compact('title', 'products', 'brands',  'sortType'));
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
        $title = 'Thêm sản phẩm';
        return view('admin.product.create', compact('title', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check the product name is the same, then refuse
        $sameProduct = Product::where("name", "=", $request->name_product)->first();
        if ($sameProduct) {
            return response()->json([
                'status' => 500,
                'msg' => 'Duplicate name'
            ]);
        }

        //take the time to set up the photo name
        $product = new Product();
        $time = $product->currentTime();
        $times = Carbon::createFromFormat('Y-m-d H:i:s', $time);
        $times = $times->format('siHdmY');


        // processing to remove VNĐ and commas
        $price = explode(" ", $request->price_product);
        $price = explode(",", $price[0]);
        $price = implode("", $price);
        if ($price < 100000 || $price > 1000000000)
            return response()->json([
                'status' => 500,
                'msg' => 'Minimum selling price 100,000 VND'
            ]);
        // processing to remove %
        $discount = explode("%", $request->discount_product);
        if ($discount[0] < 0 || $discount[0] > 99)
            return response()->json([
                'status' => 500,
                'msg' => 'Up to 99% discount'
            ]);

        /** Kiểm tra tất cả dữ liệu đầu vào của $request
         * Required tất cả dữ liệu bắt buộc phải nhập
         * Image 6 ảnh chỉ chấp nhận 3 loại file: png, jpg, webp
         */
        $name = $request->name_product;
        $id_image = strtolower($name);
        $id_image = explode(" ", $id_image);
        $id_image = implode("-", $id_image);
        //delete Vietnamese with accents
        $id_image = $this->stripVN($id_image);

        // insert data of image
        $id_image = $id_image . "-" . $times;
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
        $maxID = $product->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;
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
        $file = $request->file('image');
        $nameImage = [$image_1, $image_2, $image_3, $image_4, $image_5, $image_6];
        $this->moveImageProduct($request->brand_id, $request->product_category_id, $file, $nameImage);
        return response()->json([
            'status' => 200,
            'msg' => 'Create product successfully',
            'id' => $maxID,
        ]);
    }
    public function moveImageProduct($brand, $gender, $file, $name)
    {
        $product = new Product();
        // get slug path gender and brand for product
        $slugBrand = Brand::query()
            ->where("id",  $brand,)
            ->get();
        $slugGender = $product->checkGender($gender);
        // add image for list image of product
        $destinationPath = 'images/images-product' . "/" . $slugGender . "/" . $slugBrand[0]->slug . "/";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
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
        return view('admin.product.show', compact('title', 'product'));
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
            $title = 'Cập nhật sản phẩm';
            $slugGender = $product->checkGender($product->gender);
            return view('admin.product.edit', compact('title', 'slugGender', 'product', 'brands'));
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
    public function update(ProductUpdateRequest $request, $id)
    {
        //Check the product name is the same, then refuse
        $sameProduct = Product::where("name", "=", $request->name_product)->first();
        if ($sameProduct) {
            if ($sameProduct->id != $id) {
                return response()->json([
                    'status' => 500,
                    'msg' => 'Duplicate name'
                ]);
            }
        }
        // find product
        $product = Product::find($id);
        // processing to remove VNĐ and commas
        $price = explode(" ", $request->price_product);
        $price = explode(",", $price[0]);
        $price = implode("", $price);
        if ($price < 100000 || $price > 1000000000)
            return response()->json([
                'status' => 500,
                'msg' => 'Minimum selling price 100,000 VND'
            ]);
        // processing to remove %
        $discount = explode("%", $request->discount_product);
        if ($discount[0] < 0 || $discount[0] > 99)
            return response()->json([
                'status' => 500,
                'msg' => 'Up to 99% discount'
            ]);
        // insert data of product
        $dataProduct = [
            "name" => $request->name_product,
            "description" => $request->description_product,
            "quantity" => $request->quantity_product,
            "price" => $price,
            "discount" => $discount[0],
            "gender" => $request->product_category_id,
            "brand" => $request->brand_id,
            "updated_at" => $this->products->currentTime(),
        ];
        // check if gender or brand changes then move image in folder to folder corresponding to gender and brand
        if (($product->brand != $request->brand_id) && ($product->gender != $request->product_category_id)) {
            $this->copyImageUpdate($id, $request->product_category_id, $request->brand_id);
        } else if ($product->brand != $request->brand_id) {
            $this->copyImageUpdate($id, $product->gender, $request->brand_id);
        } else if ($product->gender != $request->product_category_id) {
            $this->copyImageUpdate($id, $request->product_category_id, $product->brand);
        }
        $product->update($dataProduct);
        //If there is a change to the array image, then proceed to edit the image
        /**
         * because we have performed the operation to replace the image position corresponding to the slug of gender and brand
         * After the update is completed, the slug of gender and brand has been updated. So the image change event (if any) still runs normally
         */
        if ($request->image) {
            $files = $request->file('image');
            $slugGender = $product->checkGender($product->gender);
            foreach ($files as $key => $file) {
                $image = "image_" . strval($key + 1);
                $imageProduct = $product->productImage["" . $image . ""];
                // get path image of product by slug brand and gender
                $images = "images/images-product/" . $slugGender . "/" . $product->productBrand["slug"] . "/" . $imageProduct;
                if (File::exists($images)) {
                    File::delete($images);
                }
                $files[$key]->move(public_path("/images/images-product/" . $slugGender . "/" . $product->productBrand["slug"] . "/"), $imageProduct);
                if ($key == 0) {
                    $destinationPathHome = "images/image_products_home/" . $imageProduct;
                    if (File::exists($destinationPathHome)) {
                        File::delete($destinationPathHome);
                        File::copy(public_path($images), public_path($destinationPathHome));
                    }
                }
            };
        }
        return response()->json([
            'status' => 200,
            'msg' => 'Update product successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        // delete image in table images of product
        $product = Product::find($request->id);
        // delete product
        $image = Image::query()->where("id", $product->image)->selectRaw("*")->get();
        $slugGender = $product->checkGender($product->gender);
        $pathHome = "images/image_products_home/";
        for ($i = 1; $i <= 6; $i++) {
            $path = "images/images-product/" . $slugGender . "/" . $product->productBrand["slug"] . "/";
            $name = "image_" . $i;
            $path = $path . $image[0]->$name;
            if ($i == 1) {
                $pathHome = $pathHome . $image[0]->$name;
                if (File::exists($pathHome)) {
                    File::delete($pathHome);
                }
            }
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        Image::query()->where("id", $product->image)->delete();
        return response()->json([
            'status' => 200,
            'msg' => 'Delete product successfully'
        ]);
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
    public function copyImageUpdate($id, $idGender, $idBrand)
    {
        $product = Product::find($id);
        // get slug of brand and gender when it changes
        $slugBrand = Brand::query()->selectRaw("brands.*")->where("id", $idBrand)->get();
        $oldGender = $product->checkGender($product->gender);
        $oldBrand = $product->productBrand["slug"];
        $newGender = $product->checkGender($idGender);
        $newBrand = $slugBrand[0]->slug;;
        for ($i = 1; $i <= 6; $i++) {
            $image = "image_" . $i;
            $imageProduct = $product->productImage["" . $image . ""];
            $oldImage = "images/images-product/" . $oldGender . "/" . $oldBrand  . "/" . $imageProduct;
            $destinationNewFolder = "images/images-product/" . $newGender . "/" .   $newBrand . "/" . $imageProduct;
            if (File::exists($oldImage)) {
                File::copy(public_path($oldImage), public_path($destinationNewFolder));
                File::delete($oldImage);
            }
        }
    }
}
