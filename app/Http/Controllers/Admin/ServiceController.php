<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::withCount('categories')->orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'icon' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'description', 'icon');
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

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'icon' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'description', 'icon');
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

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
