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
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function index(Request $request)
    {
        $title = 'Danh sách sản phẩm';
        // Lọc sản phẩm theo thương hiệu và danh mục
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

        // Tìm kiếm tên sản phẩm
        if (!empty($request->search)) {
            $search = $request->search;
        }

        // Sắp xếp sản phẩm theo giá tiền, giảm giá và số lượng
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

        // Lấy danh sách thương hiệu
        $brands = Brand::orderBy('name', 'ASC')->get();

        // Lấy danh sách sản phẩm
        $products = $this->products->getAllProducts($filters, $search, $sortArr);

        return view('admin.product.index', compact('title', 'products', 'brands', 'sortType'));
    }
    public function create()
    {
        // lấy danh sách thương hiệu và giới tính

        $brands = Brand::get();
        $title = 'Thêm sản phẩm';
        return view('admin.product.create', compact('title', 'brands'));
    }
    public function store(Request $request)
    {
        // Kiểm tra tên sản phẩm có giống nhau không thì từ chối
        $sameProduct = Product::where("name", "=", $request->name_product)->first();
        if ($sameProduct) {
            return response()->json([
                'status' => 422,
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
        $id_image = Str::slug($name);

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

        // Lấy slug path gender và brand cho sản phẩm
        $slugBrand = Brand::query()
            ->where("id", $brand,)
            ->get();
        $slugGender = $product->checkGender($gender);

        // Thêm hình ảnh vào danh sách hình ảnh của sản phẩm
        $destinationPath = 'images/images-product' . "/" . $slugGender . "/" . $slugBrand[0]->slug . "/";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        for ($i = 0; $i < count($file); $i++) {
            $file[$i]->move(public_path($destinationPath), $name[$i]);
        }

        // Thêm hình ảnh xem trước cho font web như: trang chủ, cửa hàng, giỏ hàng,...
        $filecpy = $destinationPath . $name[0];
        $destinationPathHome = 'images/image_products_home/' . $name[0];
        File::copy(public_path($filecpy), public_path($destinationPathHome));
    }
    public function show(Product $product)
    {
        $title = 'Chi tiết sản phẩm';
        return view('admin.product.show', compact('title', 'product'));
    }
    public function edit($id)
    {
        $product = Product::select(
            DB::raw("*, DATE_FORMAT(create_at,'%H:%i:%s %d-%m-%Y') as created_at"),
            DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
        )->find($id);
        if ($product) {
            $brands = Brand::get();
            $title = 'Cập nhật sản phẩm';
            $slugGender = $product->checkGender($product->gender);
            return view('admin.product.edit', compact('title', 'slugGender', 'product', 'brands'));
        } else {
            return redirect('/admin/product');
        }
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        // Kiểm tra tên sản phẩm có giống nhau không, sau đó từ chối
        $sameProduct = Product::where("name", "=", $request->name_product)->first();
        if ($sameProduct) {
            if ($sameProduct->id != $id) {
                return response()->json([
                    'status' => 500,
                    'msg' => 'Tên trùng lặp'
                ]);
            }
        }
        // Tìm sản phẩm
        $product = Product::find($id);
        // Xử lý để loại bỏ VNĐ và dấu phẩy
        $price = explode(" ", $request->price_product);
        $price = explode(",", $price[0]);
        $price = implode("", $price);
        if ($price < 100000 || $price > 1000000000)
            return response()->json([
                'status' => 500,
                'msg' => 'Giá bán tối thiểu 100.000 VNĐ'
            ]);
        // Xử lý để loại bỏ %
        $discount = explode("%", $request->discount_product);
        if ($discount[0] < 0 || $discount[0] > 99)
            return response()->json([
                'status' => 500,
                'msg' => 'Giảm giá lên đến 99%'
            ]);
        // Chèn dữ liệu sản phẩm
        $dataProduct = [
            "name" => $request->name_product,
            "description" => $request->description_product,
            "quantity" => $request->quantity_product,
            "price" => $price,
            "discount" => $discount[0],
            "gender" => $request->product_category_id,
            "brand" => $request->brand_id,
            "updated_at" => $product->currentTime(),
        ];
        // Kiểm tra nếu giới tính hoặc thương hiệu thay đổi thì di chuyển hình ảnh trong thư mục đến thư mục tương ứng với giới tính và thương hiệu
        if (($product->brand != $request->brand_id) && ($product->gender != $request->product_category_id)) {
            $this->copyImageUpdate($id, $request->product_category_id, $request->brand_id);
        } else if ($product->brand != $request->brand_id) {
            $this->copyImageUpdate($id, $product->gender, $request->brand_id);
        } else if ($product->gender != $request->product_category_id) {
            $this->copyImageUpdate($id, $request->product_category_id, $product->brand);
        }
        // Cập nhật sản phẩm
        $product->update($dataProduct);
        //Nếu có thay đổi ảnh mảng thì tiến hành chỉnh sửa ảnh
        /**
         * do ta đã thực hiện thao tác thay thế vị trí ảnh tương ứng với slug của giới tính và thương hiệu
         * Sau khi cập nhật xong slug giới tính và thương hiệu đã được cập nhật. Nên sự kiện đổi ảnh (nếu có) vẫn chạy bình thường
         */
        if ($request->image) {
            $files = $request->file('image');
            $slugGender = $product->checkGender($product->gender);
            foreach ($files as $key => $file) {
                $image = "image_" . strval($key + 1);
                $imageProduct = $product->productImage["" . $image . ""];
                // lấy hình ảnh đường dẫn của sản phẩm theo thương hiệu slug và giới tính
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
        // Lấy thông tin của một đối tượng Product với id là $request->id
        $product = Product::find($request->id);

        // Lấy thông tin của một đối tượng Image với id là $product->image
        $image = Image::query()->where("id", $product->image)->selectRaw("*")->get();

        // Xóa các file ảnh liên quan đến sản phẩm
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

        // Xóa đối tượng Image với id là $product->image
        Image::query()->where("id", $product->image)->delete();

        // Truyền các biến vào một đối tượng Response
        return response()->json([
            'status' => 200,
            'msg' => 'Delete product successfully'
        ]);
    }



    public function copyImageUpdate($id, $idGender, $idBrand)
    {
        $product = Product::find($id);
        // Lấy slug của thương hiệu và giới tính khi thay đổi
        $slugBrand = Brand::query()->selectRaw("brands.*")->where("id", $idBrand)->get();
        $oldGender = $product->checkGender($product->gender);
        $oldBrand = $product->productBrand["slug"];
        $newGender = $product->checkGender($idGender);
        $newBrand = $slugBrand[0]->slug;;
        for ($i = 1; $i <= 6; $i++) {
            $image = "image_" . $i;
            $imageProduct = $product->productImage["" . $image . ""];
            // Lấy đường dẫn hình ảnh cũ
            $oldImage = "images/images-product/" . $oldGender . "/" . $oldBrand . "/" . $imageProduct;
            // Lấy đường dẫn hình ảnh mới
            $destinationNewFolder = "images/images-product/" . $newGender . "/" . $newBrand . "/" . $imageProduct;
            if (File::exists($oldImage)) {
                // Sao chép hình ảnh cũ sang thư mục mới
                File::copy(public_path($oldImage), public_path($destinationNewFolder));
                // Xóa hình ảnh cũ
                File::delete($oldImage);
            }
        }
    }
}
