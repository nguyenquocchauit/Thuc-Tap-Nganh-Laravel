<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
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
        if (!$request->slug) {
            $slug = Str::slug($string);
        } else {
            $slug = Str::slug($request->slug);
        }
        if (strlen($string) > 10) {
            $words = explode(' ', $string);
            foreach ($words as $word) {
                $id .= substr($word, 0, 1);
            }
        } else {
            $id = Str::slug($string);
            $id = str_replace('-', '', $id);
        }
        $id = strtolower($id);
        $id = ucfirst($id);

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
    public function update(BrandRequest $request, $id)
    {
        Brand::where('id', $id)
            ->update([
                "id" => $request->id,
                "name" => $request->name,
                "slug" => $request->slug
            ]);
        return redirect('/admin/brand')->with('success', 'Cập nhật hãng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug = Brand::where('id', $request->id)->pluck('slug')->first();
        Brand::where('id', $request->id)->delete();

        $pathMen = 'images/images-product/men/  ' . $slug . '"/"';
        $pathWomen = 'images/images-product/women/  ' . $slug . '"/"';
        if (!File::exists($pathMen)) {
            $this->deleteDirectory($pathMen);
        }
        if (!File::exists($pathWomen)) {
            $this->deleteDirectory($pathWomen);
        }
        return response()->json([
            'status' => 200,
            'msg' => 'Delete brand successfully'
        ]);
    }
    public function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

}
