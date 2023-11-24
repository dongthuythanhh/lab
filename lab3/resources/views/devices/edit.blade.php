@extends('layouts.master')
@section('content')
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
<form action="{{route('devices.update',$device)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{$device->name}}">

    <label for="serial">Serial</label>
    <input type="text" name="serial" id="serial" class="form-control" value="{{$device->serial}}">

    <label for="model">Model</label>
    <input type="text" name="model" id="model" class="form-control" value="{{$device->model}}">

    <label for="is_active">Is_Active</label>

    <input type="radio" name="is_active" id="is_active1" @if ($device->is_active == App\Models\Device::ACTIVE) checked @endif
    value="{{\App\Models\Device::ACTIVE}}">
    <label for="is_status1">ACTIVE</label>

    <input type="radio" name="is_active" id="is_active2" @if ($device->is_active == App\Models\Device::INACTIVE) checked @endif
    value="{{\App\Models\Device::INACTIVE}}">
    <label for="is_status2">INACTIVE</label> <br>

    <label for="img">Img</label>
    <input type="file" name="img" id="img" class="form-control" value="{{$device->img}}">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection