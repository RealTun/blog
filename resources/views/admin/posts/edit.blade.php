@extends('admin.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post
                        <small>Edit</small>
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
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $post->category_id)
                                        selected
                                    @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="title" placeholder="Please Enter Title"
                                value="{{ $post->title }}" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-control" name="description" placeholder="Please Enter Description"
                                value="{{ $post->description }}" />
                        </div>
                        <div class="form-group">
                            <label>New post</label>
                            <input type="checkbox" class="check-control"
                                @if ($post->new_post == 1) checked="true" @endif name="new_post" />
                        </div>
                        <div class="form-group">
                            <label>Highlight post</label>
                            <input type="checkbox" class="check-control"
                                @if ($post->highlight_post == 1) checked="true" @endif name="highlight_post" />
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="content" name="content" class="ckeditor">{{ $post->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
