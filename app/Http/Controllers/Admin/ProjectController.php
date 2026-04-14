<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'status' => 'required|in:completed,ongoing',
            'client_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'completion_date' => 'nullable|string|max:255',
            'project_manager' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['featured_image', 'gallery_images']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $data['gallery_images'] = $galleryPaths;
        }

        $data['is_active'] = $request->has('is_active');
        $data['order'] = Project::max('order') + 1;

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'status' => 'required|in:completed,ongoing',
            'client_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'completion_date' => 'nullable|string|max:255',
            'project_manager' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['featured_image', 'gallery_images', 'remove_gallery']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        // Handle gallery images
        $existingGallery = $project->gallery_images ?? [];

        // Remove selected images
        if ($request->has('remove_gallery')) {
            $existingGallery = array_values(array_diff($existingGallery, $request->remove_gallery));
        }

        // Add new gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $existingGallery[] = $file->store('projects/gallery', 'public');
            }
        }

        $data['gallery_images'] = $existingGallery;
        $data['is_active'] = $request->has('is_active');

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
