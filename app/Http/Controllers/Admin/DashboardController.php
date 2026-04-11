<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Video;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalServices' => Service::count(),
            'totalProjects' => Project::count(),
            'totalGallery' => Gallery::count(),
            'totalFaqs' => Faq::count(),
            'unreadContacts' => Contact::where('is_read', false)->count(),
            'totalTeam' => TeamMember::count(),
            'totalMenus' => Menu::count(),
            'totalBanners' => Banner::count(),
            'totalBlogs' => Blog::count(),
            'totalVideos' => Video::count(),
            'recentContacts' => Contact::latest()->take(5)->get(),
            'recentProjects' => Project::latest()->take(5)->get(),
        ]);
    }
}
