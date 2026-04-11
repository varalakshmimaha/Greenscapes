<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('category')->orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('category', 'question', 'answer', 'order');
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', Faq::max('order') + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('faqs', 'public');
        }

        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('category', 'question', 'answer', 'order');
        $data['is_active'] = $request->has('is_active');

        if ($request->has('remove_image')) {
            $data['image'] = null;
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('faqs', 'public');
        }

        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($items as $index => $id) {
            Faq::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
