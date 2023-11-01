@extends('admin.layouts.master')

@section('title')
    Post
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post
                        <small>List</small>
                    </h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Highlight post</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td><img src="{{asset('image/post/' . $post->image)}}" alt="image" height="50px"></td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->highlight_post == 1 ? 'x' : '' }}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('admin.posts.delete', $post->id)}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('admin.posts.edit', $post->id)}}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        
        <!-- /.container-fluid -->
    </div>
@endsection
