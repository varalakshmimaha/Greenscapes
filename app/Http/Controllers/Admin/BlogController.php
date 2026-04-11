<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }
        $data['is_published'] = $request->has('is_published');
        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }
        $data['is_published'] = $request->has('is_published');
        if ($data['is_published'] && !$blog->published_at) {
            $data['published_at'] = now();
        }

        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
