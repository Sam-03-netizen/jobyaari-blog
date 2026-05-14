<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
  public function index()
{
    $blogs = Blog::latest()->paginate(6);

    $categories = Category::all();

    return view('blogs.index', compact('blogs', 'categories'));
}

    public function create()
    {
        $categories = Category::all();

        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'short_description' => 'required|min:10',
            'content' => 'required|min:20',
            'category_id' => 'required',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('blogs', 'public');

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_description' => $request->short_description,
            'content' => $request->content,
            'image_path' => $imagePath,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('blogs.index')
                         ->with('success', 'Blog created successfully');
    }
    public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    $blog->delete();

    return redirect()->route('blogs.index')
                     ->with('success', 'Blog deleted successfully');
}
public function edit($id)
{
    $blog = Blog::findOrFail($id);

    $categories = Category::all();

    return view('blogs.edit', compact('blog', 'categories'));
}

public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    $blog->update([
        'title' => 'required|min:5|max:255',
        'slug' => Str::slug($request->title),
        'short_description' => 'required|min:10',
        'content' => 'required|min:20',
        'category_id' => $request->category_id
    ]);

    if ($request->hasFile('image')) {

        $imagePath = $request->file('image')
                             ->store('blogs', 'public');

        $blog->update([
            'image_path' => $imagePath
        ]);
    }

    return redirect()->route('blogs.index')
                     ->with('success', 'Blog updated successfully');
}
public function filter(Request $request)
{
    $blogs = Blog::query();

    if ($request->category_id) {
        $blogs->where('category_id', $request->category_id);
    }

    $blogs = $blogs->latest()->get();

    return view('blogs.partials.blogs', compact('blogs'))->render();
}
public function show(Blog $blog)
{
    $recentBlogs = Blog::latest()
                        ->where('id', '!=', $blog->id)
                        ->take(3)
                        ->get();

    return view('blogs.show', compact('blog', 'recentBlogs'));
}
public function search(Request $request)
{
    $search = $request->search;

    $blogs = Blog::where('title', 'LIKE', "%{$search}%")
                ->latest()
                ->get();

    return view('blogs.partials.blogs', compact('blogs'))->render();
}
}