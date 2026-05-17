<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seoSettings = [
            'meta_title' => Setting::get('meta_title', 'SR Greenscapes Pvt Ltd'),
            'meta_description' => Setting::get('meta_description', 'Professional landscaping services in Bangalore'),
            'meta_keywords' => Setting::get('meta_keywords', ''),
            'og_title' => Setting::get('og_title', 'SR Greenscapes Pvt Ltd'),
            'og_description' => Setting::get('og_description', ''),
            'og_image' => Setting::get('og_image', ''),
            'twitter_title' => Setting::get('twitter_title', ''),
            'twitter_description' => Setting::get('twitter_description', ''),
            'twitter_image' => Setting::get('twitter_image', ''),
        ];
        return view('admin.seo.index', compact('seoSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'meta_title' => 'required|string|max:70',
            'meta_description' => 'required|string|max:160',
            'meta_keywords' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:70',
            'og_description' => 'nullable|string|max:160',
            'twitter_title' => 'nullable|string|max:70',
            'twitter_description' => 'nullable|string|max:160',
        ]);

        Setting::set('meta_title', $request->meta_title, 'seo');
        Setting::set('meta_description', $request->meta_description, 'seo');
        Setting::set('meta_keywords', $request->meta_keywords, 'seo');
        Setting::set('og_title', $request->og_title ?? $request->meta_title, 'seo');
        Setting::set('og_description', $request->og_description ?? $request->meta_description, 'seo');
        Setting::set('twitter_title', $request->twitter_title ?? $request->meta_title, 'seo');
        Setting::set('twitter_description', $request->twitter_description ?? $request->meta_description, 'seo');

        return redirect()->route('admin.seo.index')->with('success', 'SEO settings updated successfully.');
    }
}
