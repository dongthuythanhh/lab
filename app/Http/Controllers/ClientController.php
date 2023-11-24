<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'clients.';
    const PATH_UPLOAD = 'client';
    public function index()
    {
        $data = Client::query()->latest()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
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
        $pathUpload = 'path';
        $data = $request->except('img');
        if($request->hasFile('img')){
            $data['img'] = Storage::put($pathUpload, $request->file('img'));
        }
        Client::query()->create($data);
        return back()->with('msg','Them thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view(self::PATH_VIEW . __FUNCTION__,compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        
        return view(self::PATH_VIEW . __FUNCTION__,compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
       
        $data = $request->except('img');
        if($request->hasFile('img')){
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }
        $old = $client->img;

        if($request->hasFile('img')){
            Storage::delete($old);
        }
        $client->update($data);
        return back()->with('msg','Them thanh cong');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('msg','Them thanh cong');

    }
}
