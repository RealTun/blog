@extends('admin.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Edit</small>
                    </h1>
                    @if (count($errors))
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{route('admin.users.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" value="{{$user->name}}" placeholder="Please Enter Name" required />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Please Enter Email" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Please Enter Password"/>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirm" placeholder="Please Confirm Password"/>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <label class="radio-inline">
                                <input name="is_admin" value="0" @if(!$user->is_admin) checked @endif type="radio">User
                            </label>
                            <label class="radio-inline">
                                <input name="is_admin" value="1" @if($user->is_admin) checked @endif type="radio">Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">User update</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
