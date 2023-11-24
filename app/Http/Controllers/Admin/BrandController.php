<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.brands.';
    const PATH_UPLOAD = 'brands';

    public function index()
    {
        $data = Brand::query()->latest()->paginate(10);
        return view(self::PATH_VIEW. __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW. __FUNCTION__);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:brands',
            'img'=>'nullable|image|max:2048',
            'is_show'=>[
                Rule::in([1,0])
            ],
        ]);
        $data = $request->except('img');

        if($request->hasFile('img')){
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        Brand::query()->create($data);

        return back()->with('msg', 'Thao tac thanh cong');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view(self::PATH_VIEW. __FUNCTION__,compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'=>'required|max:50|unique:brands,name,' . $brand->id ,
            'img'=>'nullable|image|max:2048',
            'is_show'=>[
                Rule::in([1,0])
            ],
        ]);

        $data = $request->except('img');

        if($request->hasFile('img')){
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        $oldImg = $brand->img;

        $brand->update($data);

        if($request->hasFile('img') && Storage::exists($oldImg)){
            Storage::delete($oldImg);
        }

        return back()->with('msg', 'Thao tac thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        if(Storage::exists($brand->img)){
            Storage::delete($brand->img);
        }
        return back()->with('msg', 'Thao tac thanh cong');
    }
}
