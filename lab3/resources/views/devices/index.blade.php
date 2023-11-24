@extends('layouts.master')
@section('content')
    <a href="{{route('devices.create')}}" class="btn btn-success">Add</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Serial</th>
                <th>Model</th>
                <th>Is_active</th>
                <th>Img</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item )
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->serial}}</td>
                    <td>{{$item->model}}</td>
                    <td>{{$item->is_active}}</td>
                    <td>
                        <img width="100px" src="{{Storage::url($item->img)}}" alt="">
                    </td>
                    <td>
                        <form action="{{route('devices.destroy',$item)}}" method="post">
                            <a href="{{route('devices.edit',$item)}}" class="btn btn-warning">Edit</a>
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Ban co muon xoa khong ?')" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$data->Links()}}
@endsection