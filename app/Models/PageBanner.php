<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    protected $fillable = ['page', 'image', 'title', 'subtitle'];

    public const PAGES = [
        'about'     => 'About Us',
        'services'  => 'Services',
        'projects'  => 'Projects',
        'process'   => 'Our Process',
        'faqs'      => "FAQ's",
        'resources' => 'Resources',
        'contact'   => 'Contact Us',
        'cta'       => 'CTA Banner (All Pages)',
    ];
}
