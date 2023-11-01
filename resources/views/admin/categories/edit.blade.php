@extends('admin.layouts.master')

@section('title')
    Category
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                    @if (count($errors))
                    <div class="alert alert-danger">
                        @foreach ($errors as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Category ID</label>
                            <input class="form-control" name="name" placeholder="Please Enter Category Name" value="{{$category->id}}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Category Name" value="{{$category->name}}" required />
                        </div>
                        <button type="submit" class="btn btn-default">Update</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
