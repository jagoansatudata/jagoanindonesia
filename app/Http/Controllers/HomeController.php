<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CareerStats;
use App\Models\Client;
use App\Models\ClientReview;
use App\Models\Faq;
use App\Models\HeroSection;
use App\Models\InternExperience;
use App\Models\TeamMember;
use App\Models\University;

class HomeController extends Controller
{
    /**
     * Display the home page with active clients.
     */
    public function index()
    {
        $clients = Client::active()->ordered()->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->orderBy('name')->get();
        $clientReviews = ClientReview::active()->ordered()->get();
        $heroSections = HeroSection::where('is_active', true)->orderBy('created_at')->get() ?? collect([]);
        
        // Fetch latest news (type = 'news')
        $latestNews = Blog::published()
            ->news()
            ->latest('published_at')
            ->take(3)
            ->get();
            
        // Fetch latest blogs (type = 'blog')
        $latestBlogs = Blog::published()
            ->blogs()
            ->latest('published_at')
            ->take(3)
            ->get();
        
        return view('pages.home', compact('clients', 'teamMembers', 'clientReviews', 'heroSections', 'latestNews', 'latestBlogs'));
    }

    public function career()
    {
        $internExperiences = InternExperience::active()->ordered()->get();
        $universities = University::active()->ordered()->get();
        $faqs = Faq::published()->ordered()->get();
        $careerStats = CareerStats::active()->ordered()->get();
        return view('pages.career', compact('internExperiences', 'universities', 'faqs', 'careerStats'));
    }
}
