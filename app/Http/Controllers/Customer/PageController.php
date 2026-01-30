<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('customer.pages.about');
    }

    public function contact()
    {
        return view('customer.pages.contact');
    }

    public function faq()
    {
        return view('customer.pages.faq');
    }

    public function terms()
    {
        return view('customer.pages.terms');
    }

    public function privacy()
    {
        return view('customer.pages.privacy-policy');
    }

    public function shipping()
    {
        return view('customer.pages.shipping-policy');
    }

    public function sizeGuide()
    {
        return view('customer.pages.size-guide');
    }

    public function videos()
    {
        $videos = \App\Models\Video::where('status', 1)
            ->orderBy('is_featured', 'desc')
            ->latest()
            ->get();
        return view('customer.pages.videos', compact('videos'));
    }
}
