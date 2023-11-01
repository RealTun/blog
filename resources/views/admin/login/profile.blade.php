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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" value="{{ auth()->user()->name }}"
                                placeholder="Please Enter Name" required />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}"
                                placeholder="Please Enter Email" readonly />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirm"
                                placeholder="Please Confirm Password" />
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
