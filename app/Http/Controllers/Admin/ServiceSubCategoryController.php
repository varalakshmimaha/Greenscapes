<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceSubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = ServiceSubCategory::with('category.service')->orderBy('order')->get();
        return view('admin.service-subcategories.index', compact('subCategories'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $categories = ServiceCategory::where('is_active', true)->with('service')->orderBy('name')->get();
        return view('admin.service-subcategories.create', compact('services', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only('service_category_id', 'name', 'description');
        $slug = Str::slug($request->name);
        $count = ServiceSubCategory::where('slug', $slug)->count();
        $data['slug'] = $count ? $slug . '-' . ($count + 1) : $slug;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = ServiceSubCategory::max('order') + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service-subcategories', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('service-subcategories/pdfs', 'public');
        }

        ServiceSubCategory::create($data);

        if ($request->has('redirect_back')) {
            return redirect($request->redirect_back)->with('success', 'Sub Category created successfully.');
        }
        return redirect()->route('admin.service-subcategories.index')->with('success', 'Sub Category created successfully.');
    }

    public function edit(ServiceSubCategory $serviceSubcategory)
    {
        $serviceSubcategory->load('category.service');
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $categories = ServiceCategory::where('is_active', true)->with('service')->orderBy('name')->get();
        return view('admin.service-subcategories.edit', compact('serviceSubcategory', 'services', 'categories'));
    }

    public function update(Request $request, ServiceSubCategory $serviceSubcategory)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only('service_category_id', 'name', 'description');
        $slug = Str::slug($request->name);
        $count = ServiceSubCategory::where('slug', $slug)->where('id', '!=', $serviceSubcategory->id)->count();
        $data['slug'] = $count ? $slug . '-' . ($count + 1) : $slug;
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service-subcategories', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('service-subcategories/pdfs', 'public');
        }

        $serviceSubcategory->update($data);
        return redirect()->route('admin.service-subcategories.index')->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(ServiceSubCategory $serviceSubcategory)
    {
        $serviceSubcategory->delete();
        return redirect()->route('admin.service-subcategories.index')->with('success', 'Sub Category deleted successfully.');
    }
}
