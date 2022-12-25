<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\User;
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
        if(!empty($request->search)) {
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
        $data = $request->all();
        Brand::create($data);
        return redirect('admin/brand')->with('success', 'Thêm hãng thành công');
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
        return view('admin.brand.show',compact('title','brand'));

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
        return view('admin.brand.edit', compact('title','brand', 'brand'));
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
    public function destroy($id)
    {
        Brand::where('id', $id)->delete();
        return redirect('/admin/brand')->with('success', 'Xóa hãng thành công');
    }
}
