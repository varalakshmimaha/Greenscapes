<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Models\TeamCategory;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::with('category')->orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        $categories = TeamCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.team.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }
        $data['is_active'] = $request->has('is_active');
        $data['order'] = TeamMember::max('order') + 1;

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        $categories = TeamCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.team.edit', ['member' => $team, 'categories' => $categories]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
