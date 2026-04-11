<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::withCount(['services', 'subCategories'])->orderBy('order')->get();
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = ServiceCategory::max('order') + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service-categories', 'public');
        }

        ServiceCategory::create($data);
        return redirect()->route('admin.service-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.service-categories.edit', compact('serviceCategory'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service-categories', 'public');
        }

        $serviceCategory->update($data);
        return redirect()->route('admin.service-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('admin.service-categories.index')->with('success', 'Category deleted successfully.');
    }
}
