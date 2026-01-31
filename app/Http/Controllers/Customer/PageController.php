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

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'newsletter' => 'nullable|boolean',
        ]);

        try {
            // Get store email from settings or use a fallback
            $storeEmail = \App\Helpers\SettingsHelper::get('store_email', 'contact@vedherbs.com');

            // Send email
            \Illuminate\Support\Facades\Mail::to($storeEmail)
                ->send(new \App\Mail\ContactFormMail($validated));

            return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact Form Error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Unable to send message. Please try again later.']);
        }
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
