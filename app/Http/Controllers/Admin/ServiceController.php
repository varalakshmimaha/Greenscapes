<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with(['serviceCategory', 'serviceSubCategory'])->orderBy('order');
        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }
        $services = $query->get();
        $categories = ServiceCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('name')->get();
        $subCategories = ServiceSubCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.create', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'icon' => 'nullable|string|max:255',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'service_sub_category_id' => 'nullable|exists:service_sub_categories,id',
        ]);

        $data = $request->except(['image', 'pdf']);
        $data['slug'] = Str::slug($request->name);
        $data['category'] = 'design';
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('services/pdfs', 'public');
        }
        $data['is_active'] = $request->has('is_active');
        $data['order'] = Service::max('order') + 1;
        $data['service_category_id'] = $request->service_category_id ?: null;
        $data['service_sub_category_id'] = $request->service_sub_category_id ?: null;

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('name')->get();
        $subCategories = ServiceSubCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.edit', compact('service', 'categories', 'subCategories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'icon' => 'nullable|string|max:255',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'service_sub_category_id' => 'nullable|exists:service_sub_categories,id',
        ]);

        $data = $request->except(['image', 'pdf']);
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('services/pdfs', 'public');
        }
        if ($request->has('remove_pdf') && !$request->hasFile('pdf')) {
            $data['pdf'] = null;
        }
        $data['is_active'] = $request->has('is_active');
        $data['service_category_id'] = $request->service_category_id ?: null;
        $data['service_sub_category_id'] = $request->service_sub_category_id ?: null;

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    // AJAX: Get sub-categories for a given category
    public function getSubCategories($categoryId)
    {
        $subs = ServiceSubCategory::where('service_category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);
        return response()->json($subs);
    }
}
