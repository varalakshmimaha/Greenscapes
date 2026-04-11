<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamCategoryController extends Controller
{
    public function index()
    {
        $categories = TeamCategory::withCount('members')->orderBy('order')->get();
        return view('admin.team-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.team-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        TeamCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->has('is_active'),
            'order' => TeamCategory::max('order') + 1,
        ]);

        return redirect()->route('admin.team-categories.index')->with('success', 'Team category created successfully.');
    }

    public function edit(TeamCategory $teamCategory)
    {
        return view('admin.team-categories.edit', ['category' => $teamCategory]);
    }

    public function update(Request $request, TeamCategory $teamCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $teamCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.team-categories.index')->with('success', 'Team category updated successfully.');
    }

    public function destroy(TeamCategory $teamCategory)
    {
        $teamCategory->delete();
        return redirect()->route('admin.team-categories.index')->with('success', 'Team category deleted successfully.');
    }
}
