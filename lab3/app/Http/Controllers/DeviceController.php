<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'devices.';
    const PATH_UPLOAD = 'devices';
    public function index()
    {
        $data = Device::query()->latest()->paginate();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'serial' => 'required|unique:devices|max:50',
            'model' => 'required|max:50',
            'is_active' => [
                'required',
                Rule::in([
                    Device::ACTIVE,
                    Device::INACTIVE,
                ])
            ],
            'img' => 'nullable|max:225|image|',
        ]);
        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        Device::query()->create($data);

        return back()->with('msg', 'Thuc hien thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|max:100',
            'serial' => 'required|unique:devices|max:50',
            'model' => 'required|max:50',
            'is_active' => [
                'required',
                Rule::in([
                    Device::ACTIVE,
                    Device::INACTIVE,
                ])
            ],
            'img' => 'nullable|max:225|image|',
        ]);
        
        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }
        $oldImg = $device->img;

        $device->update($data);

        if ($request->hasFile('img') && Storage::exists($oldImg)) {
            Storage::delete($oldImg);
        }
        return back()->with('msg', 'Thuc hien thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();

        if (Storage::exists($device->img)) {
            Storage::delete($device->img);
        }
        return back()->with('msg', 'Thuc hien thanh cong');
    }
}
