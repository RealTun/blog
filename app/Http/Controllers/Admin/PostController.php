<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'image' => 'required',
                'category_id' => 'required',
            ]
        );

        $slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if (
                strcasecmp($extension, 'jpg') === 0
                || strcasecmp($extension, 'png' === 0)
                || strcasecmp($extension, 'jpeg') === 0
            ) {
                $image = time() . '_' . $name_file;

                $file->move(public_path('image/post/'), $image);
            }
        }

        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "content" => $request->get('content'),
            "image" => $image,
            "view_counts" => 0,
            "user_id" => 1,
            "slug" => $slug,
            "category_id" => $request->category_id,
            "new_post" => $request->new_post ? 1 : 0,
            "highlight_post" => $request->highlight_post ? 1 : 0,
        ]);


        Session::flash('success', 'Create post successful');
        return redirect()->route('admin.posts.index');
    }

    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'category_id' => 'required',
            ]
        );

        $slug = Str::slug($request->name);
        // $checkSlug = Post::where('slug', $slug)->first();
        // while ($checkSlug) {
        //     $slug = $checkSlug->slug . time();
        // }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if (
                strcasecmp($extension, 'jpg') === 0
                || strcasecmp($extension, 'png' === 0)
                || strcasecmp($extension, 'jpeg') === 0
            ) {
                $image = time() . '_' . $name_file;

                $file->move(public_path('image/post/'), $image);
            }
        }

        $post = Post::find($id);
        $post->update([
            "title" => $request->title,
            "description" => $request->description,
            "content" => $request->get('content'),
            "image" => isset($image) ? $image : $post->image,
            "slug" => $slug,
            "category_id" => $request->category_id,
            "new_post" => $request->new_post ? 1 : 0,
            "highlight_post" => $request->highlight_post ? 1 : 0,
        ]);

        Session::flash('success', 'Update post successful');
        return redirect()->route('admin.posts.index');
    }

    public function delete(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', 'Delete post successful');
        return redirect()->route('admin.posts.index');
    }
}
