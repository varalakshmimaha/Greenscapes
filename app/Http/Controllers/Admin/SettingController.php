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
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg',
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

    public function brochure()
    {
        $settings = Setting::where('group', 'brochure')->pluck('value', 'key');
        return view('admin.settings.brochure', compact('settings'));
    }

    public function updateBrochure(Request $request)
    {
        $request->validate([
            'brochure_file' => 'nullable|mimes:pdf',
        ]);

        if ($request->hasFile('brochure_file')) {
            $path = $request->file('brochure_file')->store('settings', 'public');
            Setting::set('brochure_file', $path, 'brochure');
        }

        return back()->with('success', 'Brochure updated successfully.');
    }

    public function integrations()
    {
        $settings = Setting::where('group', 'integrations')->pluck('value', 'key');
        return view('admin.settings.integrations', compact('settings'));
    }

    public function updateIntegrations(Request $request)
    {
        $request->validate([
            'notification_email'   => 'nullable|email|max:255',
            'google_analytics_id'  => 'nullable|string|max:50',
        ]);

        $fields = ['notification_email', 'google_analytics_id'];
        foreach ($fields as $field) {
            Setting::set($field, $request->input($field), 'integrations');
        }

        return back()->with('success', 'Integration settings updated successfully.');
    }
}
