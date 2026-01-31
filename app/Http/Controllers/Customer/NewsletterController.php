<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'newsletter_email' => 'required|email|max:255|unique:newsletter_subscribers,email',
        ], [
            'newsletter_email.unique' => 'You are already subscribed to our newsletter.',
        ]);

        try {
            \App\Models\NewsletterSubscriber::create([
                'email' => $request->newsletter_email,
                'is_active' => true,
            ]);

            return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to subscribe. Please try again later.']);
        }
    }
}
