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
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\Setting;
use App\Models\TeamCategory;
use App\Models\TeamMember;
use App\Models\Counter;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Video;
use App\Mail\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        // Get the 9 main services for home page
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();
        $projects = Project::where('is_active', true)->orderBy('order')->take(16)->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->take(4)->get();
        $faqs = Faq::where('is_active', true)->where('category', 'Home Page')->orderBy('order')->get();
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
        $teamCategories = TeamCategory::where('is_active', true)->orderBy('order')->with(['members' => function($q) {
            $q->where('is_active', true)->orderBy('order');
        }])->get();
        $activeCategory = null;
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        return view('frontend.about', compact('about', 'teamMembers', 'teamCategories', 'activeCategory', 'testimonials'));
    }

    public function ourTeam(Request $request)
    {
        $teamCategories = TeamCategory::where('is_active', true)->orderBy('order')->with(['members' => function($q) {
            $q->where('is_active', true)->orderBy('order');
        }])->get();

        $activeCategory = null;
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->get();

        return view('frontend.our-team', compact('teamMembers', 'teamCategories', 'activeCategory'));
    }

    public function teamByCategory($slug)
    {
        $category = TeamCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $about = About::where('is_active', true)->orderBy('order')->get();
        $teamMembers = TeamMember::where('is_active', true)->where('team_category_id', $category->id)->orderBy('order')->get();
        $teamCategories = TeamCategory::where('is_active', true)->orderBy('order')->get();
        $activeCategory = $category;
        return view('frontend.about', compact('about', 'teamMembers', 'teamCategories', 'activeCategory'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)
            ->withCount('categories')
            ->orderBy('order')
            ->get();

        return view('frontend.services', compact('services'));
    }


    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        // Get categories with subcategories belonging to this service
        $serviceCategories = ServiceCategory::where('service_id', $service->id)
            ->where('is_active', true)
            ->with(['subCategories' => fn($q) => $q->where('is_active', true)->orderBy('order')])
            ->orderBy('order')
            ->get();

        // Get related services (other main services)
        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('frontend.service-detail', compact('service', 'relatedServices', 'serviceCategories'));
    }


    public function serviceCategoryDetail($serviceSlug, $categorySlug)
    {
        $service = Service::where('slug', $serviceSlug)->firstOrFail();
        $category = ServiceCategory::where('slug', $categorySlug)
            ->where('service_id', $service->id)
            ->where('is_active', true)
            ->firstOrFail();

        $subCategories = ServiceSubCategory::where('service_category_id', $category->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $siblingCategories = ServiceCategory::where('service_id', $service->id)
            ->where('is_active', true)
            ->where('id', '!=', $category->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('frontend.service-category-detail', compact('service', 'category', 'subCategories', 'siblingCategories'));
    }

    public function serviceSubCategoryDetail($serviceSlug, $categorySlug, $subCategorySlug)
    {
        $service = Service::where('slug', $serviceSlug)->firstOrFail();
        $category = ServiceCategory::where('slug', $categorySlug)
            ->where('service_id', $service->id)
            ->where('is_active', true)
            ->firstOrFail();

        $subCategory = ServiceSubCategory::where('slug', $subCategorySlug)
            ->where('service_category_id', $category->id)
            ->where('is_active', true)
            ->firstOrFail();

        $siblingSubCategories = ServiceSubCategory::where('service_category_id', $category->id)
            ->where('is_active', true)
            ->where('id', '!=', $subCategory->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('frontend.service-subcategory-detail', compact('service', 'category', 'subCategory', 'siblingSubCategories'));
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

    public function blogs()
    {
        $blogs = Blog::where('is_published', true)->orderBy('published_at', 'desc')->paginate(9);
        return view('frontend.blogs', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedBlogs = Blog::where('is_published', true)->where('id', '!=', $blog->id)->latest('published_at')->take(3)->get();
        return view('frontend.blog-detail', compact('blog', 'relatedBlogs'));
    }

    public function videos()
    {
        $videos = Video::where('is_active', true)->orderBy('order')->get();
        return view('frontend.videos', compact('videos'));
    }

    public function process()
    {
        return view('frontend.process');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy-policy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function sitemap()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('frontend.sitemap', compact('services'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'details' => 'nullable|string',
        ]);

        Contact::create($request->only('name', 'email', 'phone', 'subject', 'message', 'source'));

        $notificationEmail = Setting::get('notification_email');
        if ($notificationEmail) {
            try {
                Mail::to($notificationEmail)->send(new ContactInquiry($request->only(
                    'name', 'email', 'phone', 'subject', 'message', 'details', 'source'
                )));
            } catch (\Exception $e) {
                Log::error('Contact inquiry email failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
