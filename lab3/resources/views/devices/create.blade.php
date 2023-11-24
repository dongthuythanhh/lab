@extends('layouts.master')
@section('content')

@if (\Session::has('msg'))
    <div class="alert alert-success">
        {{\Session::get('msg')}}
    </div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Error!</strong> <br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('devices.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control">

    <label for="serial">Serial</label>
    <input type="text" name="serial" id="serial" class="form-control">

    <label for="model">Model</label>
    <input type="text" name="model" id="model" class="form-control">

    <label for="is_active">Is_Active</label>

    <input type="radio" name="is_active" id="is_active1" value="{{\App\Models\Device::ACTIVE}}">
    <label for="is_status1">ACTIVE</label>

    <input type="radio" name="is_active" id="is_active2" value="{{\App\Models\Device::INACTIVE}}">
    <label for="is_status2">INACTIVE</label>


    <label for="img">Img</label>
    <input type="file" name="img" id="img" class="form-control">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection