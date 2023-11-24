@extends('layouts.master')
@section('content')
<div class="p-3">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('clients.store')}}" method="post" enctype="multipart/form-data">

        @csrf
        <label for="company">Company</label>
        <input type="text" name="company" id="company" class="form-control">

        <label for="img">Img</label>
        <input type="file" name="img" id="img" class="form-control">

        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">

        <label for="projects">Projects</label>
        <input type="text" name="projects" id="projects" class="form-control">

        <label for="invoices">Invoices</label>
        <input type="text" name="invoices" id="invoices" class="form-control">

        <label for="tags">Tags</label>
        <input type="text" name="tags" id="tags" class="form-control">

        <label for="category">Category</label>
        <input type="text" name="category" id="category" class="form-control">

        <label for="status">Status</label>

        <input type="radio" name="status" id="status-1" value="{{\App\Models\Client::STATUS_ACTIVE}}">
        <label for="status-1">{{\App\Models\Client::STATUS_ACTIVE}}</label>

        <input type="radio" name="status" id="status-2" value="{{\App\Models\Client::STATUS_INACTIVE}}">
        <label for="status-2">{{\App\Models\Client::STATUS_INACTIVE}}</label>
        <br><br>

        <button type="submit" class="btn btn-success">Submit</button>

    </form>
</div>
@endsection