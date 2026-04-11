<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }
        $data['is_active'] = $request->has('is_active');
        $data['order'] = Banner::max('order') + 1;

        Banner::create($data);
        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
