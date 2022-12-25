<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Brand;
use App\Models\Gender;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categories;
    public function __construct()
    {
        $this->categories = new Gender();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Danh sách loại';
        $search = null;
        if(!empty($request->search)) {
            $search = $request->search;
        }
        $categories = $this->categories->getAllCategories($search);
        
        return view('admin.category.index',compact('title','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm loại';
        return view('admin.category.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Gender();
        $maxID = $category->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;
        $data = [
            "id" => $maxID,
            "name" => $request->name,
            "slug" => $request->slug
        ];
        Gender::create($data);
        return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gender $category)
    {
        $title = 'Chi tiết loại';
        return view('admin.category.show',compact('title','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gender $category)
    {
        $title = 'Cập nhật loại';
        return view('admin.category.edit',compact('title','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $categories = Gender::find($id);
        $data = [
            "name" => $request->name,
            "slug" => $request->slug
        ];
        $categories->update($data);
        return redirect('/admin/category')->with('success', 'Cập nhật loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gender::destroy($id);
        return redirect('/admin/category')->with('success', 'Xóa loại thành công');
    }
}
