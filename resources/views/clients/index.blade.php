@extends('layouts.master')
@section('content')
<div class="p-3">
    <a href="{{route('clients.create')}}" class="btn btn-success"> Add</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Account Owner</th>
                <th>Projects</th>
                <th>Invoices</th>
                <th>Tags</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item )
            <tr>
                <th>{{$item->id}}</th>
                <th>{{$item->company}}</th>
                <th>
                    <img width="100px" src="{{Storage::Url($item->img)}}" alt="">
                    {{$item->name}}
                </th>
                <th>{{$item->projects}}</th>
                <th>{{$item->invoices}}</th>
                <th>{{$item->tags}}</th>
                <th>{{$item->category}}</th>
                <th>{{$item->status}}</th>
                <th>
                    <form action="{{route('clients.destroy',$item)}}" method="post">
                        <a href="{{route('clients.edit',$item)}}" class="btn btn-warning">Edit</a>

                        @csrf
                        @method('delete')

                        <button class="btn btn-danger" onclick="return confirm('Ban co muon xoa khong')">DELETE</button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$data->Links()}}
</div>
@endsection