<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with('service')->orderBy('order')->get();
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('admin.service-categories.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only('service_id', 'name', 'description');
        $slug = Str::slug($request->name);
        $count = ServiceCategory::where('slug', $slug)->count();
        $data['slug'] = $count ? $slug . '-' . ($count + 1) : $slug;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = ServiceCategory::max('order') + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service-categories', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('service-categories/pdfs', 'public');
        }

        ServiceCategory::create($data);
        return redirect()->route('admin.service-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $serviceCategory->load('subCategories');
        return view('admin.service-categories.edit', compact('serviceCategory', 'services'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only('service_id', 'name', 'description');
        $slug = Str::slug($request->name);
        $count = ServiceCategory::where('slug', $slug)->where('id', '!=', $serviceCategory->id)->count();
        $data['slug'] = $count ? $slug . '-' . ($count + 1) : $slug;
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service-categories', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('service-categories/pdfs', 'public');
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
