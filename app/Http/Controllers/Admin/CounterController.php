<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        $counters = Counter::orderBy('order')->get();
        return view('admin.counters.index', compact('counters'));
    }

    public function create()
    {
        return view('admin.counters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:10',
            'label' => 'required|string|max:255',
        ]);

        $data = $request->only(['icon', 'number', 'suffix', 'label']);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = Counter::max('order') + 1;

        Counter::create($data);
        return redirect()->route('admin.counters.index')->with('success', 'Counter added successfully.');
    }

    public function edit(Counter $counter)
    {
        return view('admin.counters.edit', compact('counter'));
    }

    public function update(Request $request, Counter $counter)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:10',
            'label' => 'required|string|max:255',
        ]);

        $data = $request->only(['icon', 'number', 'suffix', 'label']);
        $data['is_active'] = $request->has('is_active');

        $counter->update($data);
        return redirect()->route('admin.counters.index')->with('success', 'Counter updated successfully.');
    }

    public function destroy(Counter $counter)
    {
        $counter->delete();
        return redirect()->route('admin.counters.index')->with('success', 'Counter deleted successfully.');
    }
}
