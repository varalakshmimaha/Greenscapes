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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:completed,ongoing',
            'client_name' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['image', 'before_image', 'after_image']);
        $data['slug'] = Str::slug($request->title);
        foreach (['image', 'before_image', 'after_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('projects', 'public');
            }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:completed,ongoing',
            'client_name' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['image', 'before_image', 'after_image']);
        $data['slug'] = Str::slug($request->title);
        foreach (['image', 'before_image', 'after_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('projects', 'public');
            }
        }
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
