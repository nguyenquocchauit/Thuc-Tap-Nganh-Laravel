<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $brands;
    public function __construct()
    {
        $this->brands = new Brand();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Danh sách hãng';
        $search = null;
        if (!empty($request->search)) {
            $search = $request->search;
        }
        $brands = $this->brands->getAllBrands($search);
        return view('admin.brand.index', compact('title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm hãng';
        return view('admin.brand.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $slug = null;
        $id = null;
        $string = $request->name;

        // Tạo slug từ thuộc tính name nếu thuộc tính slug không tồn tại
        if (!$request->slug) {
            $slug = Str::slug($string);
        } else {
            $slug = Str::slug($request->slug);
        }

        // Tạo id từ thuộc tính name nếu chiều dài của name lớn hơn 10
        if (strlen($string) > 10) {
            $words = explode(' ', $string);
            foreach ($words as $word) {
                $id .= substr($word, 0, 1);
            }
        } else {
            // Tạo slug từ thuộc tính name và loại bỏ dấu gạch ngang
            $id = Str::slug($string);
            $id = str_replace('-', '', $id);
        }

        // Chuyển id thành chữ thường và viết hoa ký tự đầu tiên
        $id = strtolower($id);
        $id = ucfirst($id);

        // Kiểm tra xem id đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkId = Brand::where('id', $id)->exists();
        if ($checkId) {
            // Thông báo rằng giá trị của biến $id đã tồn tại trong cơ sở dữ liệu.
            $randomString = Str::random(4); // Tạo một chuỗi ngẫu nhiên có độ dài là 5 ký tự.
            $id .= $randomString;
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $slug,
            'id' => $id,
        ]);
        // Trả về phản hồi JSON với mã trạng thái và thông báo thành công
        return response()->json([
            'status' => 200,
            'msg' => 'Create brand successfully',
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Chi tiết hãng';
        $brand = Brand::where('id', $id)->first();
        return view('admin.brand.show', compact('title', 'brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where('id', $id)->first();
        $title = 'Cập nhật hãng';
        return view('admin.brand.edit', compact('title', 'brand', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        // Khởi tạo biến mới và biến cũ để lưu trữ slug của thương hiệu
        $newslug = null;
        $oldslug = Brand::where('id', $id)->pluck('slug')->first();;

        // Nếu yêu cầu có slug mới, tạo một slug mới và đổi tên các tệp tin liên quan
        if ($request->slug) {
            $newslug = Str::slug($request->slug);
            $pathWomen = 'images/images-product/women/';
            $pathMen = 'images/images-product/men/';
            if (File::exists($pathMen . $oldslug)) {
                rename($pathMen . $oldslug, $pathMen . $newslug);
            }
            if (File::exists($pathWomen . $oldslug)) {
                rename($pathWomen . $oldslug, $pathWomen . $newslug);
            }
        }

        // Cập nhật thông tin thương hiệu trong cơ sở dữ liệu
        Brand::where('id', $id)
            ->update([
                "name" => $request->name,
                "slug" => $request->slug,
            ]);

        // Trả về phản hồi JSON với mã trạng thái và thông báo thành công
        return response()->json([
            'status' => 200,
            'msg' => 'Update brand successfully'
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
        // Lấy giá trị trường slug tương ứng với id
        $slug = Brand::where('id', $request->id)->pluck('slug')->first();

        // Lấy sản phẩm đầu tiên có trường brand bằng id
        $product = Product::where('brand', $request->id)->first();
        // Kiểm tra $product là true tức là đã có sản phẩm của hãng đó và ngược lại
        if ($product) {
            // Lấy giá trị trường image_1 của sản phẩm đó
            $image = $product->productImage['image_1'];

            // Đường dẫn đến thư mục chứa ảnh sản phẩm trên trang chủ
            $pathHome = "images/image_products_home/";

            // Nếu ảnh sản phẩm tồn tại trong thư mục chứa ảnh sản phẩm trên trang chủ, xóa nó đi
            if (File::exists($pathHome . $image)) {
                File::delete($pathHome . $image);
            }
        }

        // Xóa thương hiệu có id bằng với id được gửi lên từ form
        Brand::where('id', $request->id)->delete();

        // Đường dẫn đến thư mục chứa ảnh sản phẩm cho phái nam và phái nữ của thương hiệu này
        $pathWomen = 'images/images-product/women/' . $slug . '/';
        $pathMen = 'images/images-product/men/' . $slug . '/';

        // Nếu thư mục chứa ảnh sản phẩm cho phái nam tồn tại, xóa nó đi
        if (File::exists($pathMen)) {
            $this->deleteDirectory($pathMen);
        }

        // Nếu thư mục chứa ảnh sản phẩm cho phái nữ tồn tại, xóa nó đi
        if (File::exists($pathWomen)) {
            $this->deleteDirectory($pathWomen);
        }

        // Trả về kết quả thành công với mã HTTP 200 và thông báo "Delete brand successfully"
        return response()->json([
            'status' => 200,
            'msg' => 'Delete brand successfully'
        ]);
    }

    public function deleteDirectory($dir)
    {
        // Nếu thư mục không tồn tại, trả về true
        if (!file_exists($dir)) {
            return true;
        }

        // Nếu đường dẫn không phải là một thư mục, xóa nó đi và trả về true
        if (!is_dir($dir)) {
            return unlink($dir);
        }

        // Lặp qua tất cả các tệp tin và thư mục trong thư mục hiện tại
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            // Nếu tệp tin hoặc thư mục không được xóa thành công, trả về false
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        // Xóa thư mục hiện tại và trả về true
        return rmdir($dir);
    }
}
