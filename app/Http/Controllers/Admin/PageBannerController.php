<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBanner;
use Illuminate\Http\Request;

class PageBannerController extends Controller
{
    public function index()
    {
        $banners = PageBanner::whereIn('page', array_keys(PageBanner::PAGES))
            ->get()
            ->keyBy('page');

        return view('admin.page-banners.index', compact('banners'));
    }

    public function update(Request $request, string $page)
    {
        abort_unless(array_key_exists($page, PageBanner::PAGES), 404);

        $request->validate([
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'landing_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title'          => 'nullable|string|max:255',
            'subtitle'       => 'nullable|string|max:255',
        ]);

        $banner = PageBanner::firstOrNew(['page' => $page]);

        if ($request->hasFile('image')) {
            $banner->image = $request->file('image')->store('page-banners', 'public');
        }

        if ($request->hasFile('landing_image')) {
            $banner->landing_image = $request->file('landing_image')->store('page-banners', 'public');
        }

        $banner->title    = $request->input('title');
        $banner->subtitle = $request->input('subtitle');
        $banner->save();

        return back()->with('success', PageBanner::PAGES[$page] . ' banner updated successfully.');
    }

    public function destroy(string $page)
    {
        abort_unless(array_key_exists($page, PageBanner::PAGES), 404);

        PageBanner::where('page', $page)->delete();

        return back()->with('success', PageBanner::PAGES[$page] . ' banner removed.');
    }
}
