@extends('layouts.master')
@section('content')
<div class="p-3"> 
    <h1>Danh sach thuong hieu </h1>
    <table class="table">
        <thead>
            <tr> 
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>IsShow</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item )
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name }}</td>
                <td>
                    <!-- <img width="100px" src="{{$item->img}}" alt=""> -->
                    <img src="{{\Storage::url($item->img)}}" alt="" width="100px">
                </td>
                <td>{{ $item->is_show ? 'Show' : 'Hide' }}</td>
                <td>
                    <form action="{{route('admin.brands.destroy',$item)}}" method="post">
                        <!-- <a href="{{route('admin.brands.show',$item)}}" class="btn btn-primary">Show</a> -->
                        <a href="{{route('admin.brands.edit',$item)}}" class="btn btn-warning">Edit</a>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ban co chac chan xoa khong')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$data->Links()}}
    </table>
</div>


@endsection