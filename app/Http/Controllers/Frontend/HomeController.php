<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Counter;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->take(9)->get();
        $projects = Project::where('is_active', true)->orderBy('order')->take(16)->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->take(4)->get();
        $faqs = Faq::where('is_active', true)->orderBy('order')->take(5)->get();
        $gallery = Gallery::where('is_active', true)->orderBy('order')->take(8)->get();
        $about = About::where('is_active', true)->where('section', 'overview')->first();
        $counters = Counter::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();

        return view('frontend.home', compact('banners', 'services', 'projects', 'teamMembers', 'faqs', 'gallery', 'about', 'counters', 'testimonials'));
    }

    public function about()
    {
        $about = About::where('is_active', true)->orderBy('order')->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->get();
        return view('frontend.about', compact('about', 'teamMembers'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('frontend.services', compact('services'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $relatedServices = Service::where('is_active', true)->where('id', '!=', $service->id)->take(3)->get();
        return view('frontend.service-detail', compact('service', 'relatedServices'));
    }

    public function projects()
    {
        $projects = Project::where('is_active', true)->orderBy('order')->paginate(12);
        $counters = Counter::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        return view('frontend.projects', compact('projects', 'counters', 'testimonials'));
    }

    public function projectDetail($slug)
    {
        if ($slug === 'sample-project') {
            return view('frontend.project-detail', ['project' => (object)[
                'title' => 'Villa Garden Design',
                'status' => 'RESIDENTIAL',
                'client_name' => 'Bengaluru, Karnataka',
                'description' => null
            ]]);
        }
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('frontend.project-detail', compact('project'));
    }

    public function gallery()
    {
        $gallery = Gallery::where('is_active', true)->orderBy('order')->paginate(16);
        $categories = Gallery::where('is_active', true)->whereNotNull('category')->distinct()->pluck('category');
        return view('frontend.gallery', compact('gallery', 'categories'));
    }

    public function faqs()
    {
        $faqs = Faq::where('is_active', true)->orderBy('order')->get();
        $faqCategories = $faqs->groupBy('category');
        $categories = \App\Models\Faq::CATEGORIES;
        return view('frontend.faqs', compact('faqs', 'faqCategories', 'categories'));
    }

    public function testimonials()
    {
        $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('order')->get();
        return view('frontend.testimonials', compact('testimonials'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Contact::create($request->only('name', 'email', 'phone', 'subject', 'message', 'source'));

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
