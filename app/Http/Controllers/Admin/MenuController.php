<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menus.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['has_dropdown'] = $request->has('has_dropdown');
        $data['order'] = $request->filled('order') ? $request->order : Menu::max('order') + 1;

        Menu::create($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('order')->get();
        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['has_dropdown'] = $request->has('has_dropdown');

        $menu->update($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($items as $index => $id) {
            Menu::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
