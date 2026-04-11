<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function general()
    {
        $settings = Setting::where('group', 'general')->pluck('value', 'key');
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $fields = ['site_name', 'site_tagline', 'site_email', 'site_phone', 'site_address', 'google_map_embed', 'meta_title', 'meta_description'];
        foreach ($fields as $field) {
            Setting::set($field, $request->input($field), 'general');
        }
        return back()->with('success', 'General settings updated successfully.');
    }

    public function logo()
    {
        $settings = Setting::where('group', 'logo')->pluck('value', 'key');
        return view('admin.settings.logo', compact('settings'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024',
        ]);

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path, 'logo');
        }
        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $path, 'logo');
        }
        return back()->with('success', 'Logo settings updated successfully.');
    }

    public function footer()
    {
        $settings = Setting::where('group', 'footer')->pluck('value', 'key');
        return view('admin.settings.footer', compact('settings'));
    }

    public function updateFooter(Request $request)
    {
        $fields = ['footer_about', 'footer_copyright', 'facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url', 'whatsapp_number', 'pinterest_url', 'x_url'];
        foreach ($fields as $field) {
            Setting::set($field, $request->input($field), 'footer');
        }
        return back()->with('success', 'Footer settings updated successfully.');
    }
}
