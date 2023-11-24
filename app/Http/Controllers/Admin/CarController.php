<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    const PATH_VIEW = 'admin.cars.';
    const PATH_UPLOAD = 'cars';

    public function index(){
        $data = Car::query()->latest()->paginate(10);

        return view(self::PATH_VIEW .  __FUNCTION__, compact('data'));
    }
    public function create(){

        $brands = Brand::query()->pluck('name','id')->toArray();
        return view(self::PATH_VIEW .  __FUNCTION__, compact('brands'));

    }
    public function store(Request $request){

        $request->validate([
            'name' => 'required|max:255|unique:cars',
            'img_thumbnail' => 'nullable|image|max:2048',
            'describe' => 'nullable',
            'brand_id' => [
                Rule::exists('brands','id')
            ],
            
        ]);

        $data = $request->except('img_thumbnail');

        if($request->hasFile('img_thumbnail')){
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }

        Car::query()->create($data);
        return back()->with('msg','Thuc hien thanh cong');
    }

    public function edit(Car $car){
        $brands = Brand::query()->pluck('name','id')->toArray();
        return view(self::PATH_VIEW .  __FUNCTION__, compact('car','brands'));
    }

    public function update(Request $request, Car $car){

        $request->validate([
            'name' => 'required|max:255|unique:cars,name,' . $car->id,
            'img_thumbnail' => 'nullable|image|max:2048',
            'describe' => 'nullable',
            'brand_id' => [
                Rule::exists('brands','id')
            ],
            
        ]);

        $data = $request->except('img_thumbnail');

        if($request->hasFile('img_thumbnail')){
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }

        $oldImg = $car->img_thumbnail;

        $car->update($data);

        if($request->hasFile('img_thumbnail') && Storage::exists($oldImg)){
            Storage::delete($oldImg);
        }

        return back()->with('msg','Thuc hien thanh cong');
    }

    public function destroy(Car $car){
        $car->delete();
        if(Storage::exists($car->img_thumbnail)){
            if(Storage::delete($car->img_thumbnail));
        }
        return back()->with('msg','Thuc hien thanh cong');
    }
}
