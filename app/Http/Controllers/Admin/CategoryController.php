<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.add');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=> 'required',
        ]);

        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug', $slug)->first();
        while($checkSlug){
            $slug = $checkSlug->slug . Str::random(2);
        }

        $category = new Category();
        $category->name = $validateData['name'];
        $category->slug = $slug;

        $category->save();
        Session::flash('success', 'Create category successful');
        return redirect()->route('admin.categories.index');
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name'=> 'required',
        ]);

        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug', $slug)->first();
        while($checkSlug){
            $slug = $checkSlug->slug . Str::random(2);
        }

        $category = Category::find($id);
        $category->name = $validateData['name'];
        $category->slug = $slug;

        $category->save();
        Session::flash('success', 'Update category successful');
        return redirect()->route('admin.categories.index');
    }

    public function delete(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('success', 'Delete category successful');
        return redirect()->route('admin.categories.index');
    }
}
