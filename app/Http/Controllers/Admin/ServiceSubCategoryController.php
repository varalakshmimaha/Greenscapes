<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceSubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = ServiceSubCategory::with('category')->withCount('services')->orderBy('order')->get();
        $categories = ServiceCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.service-subcategories.index', compact('subCategories', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.service-subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
        ]);

        $data = $request->only('service_category_id', 'name');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = ServiceSubCategory::max('order') + 1;

        ServiceSubCategory::create($data);
        return redirect()->route('admin.service-subcategories.index')->with('success', 'Sub Category created successfully.');
    }

    public function edit(ServiceSubCategory $serviceSubcategory)
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.service-subcategories.edit', compact('serviceSubcategory', 'categories'));
    }

    public function update(Request $request, ServiceSubCategory $serviceSubcategory)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
        ]);

        $data = $request->only('service_category_id', 'name');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        $serviceSubcategory->update($data);
        return redirect()->route('admin.service-subcategories.index')->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(ServiceSubCategory $serviceSubcategory)
    {
        $serviceSubcategory->delete();
        return redirect()->route('admin.service-subcategories.index')->with('success', 'Sub Category deleted successfully.');
    }
}
