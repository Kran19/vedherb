@extends('customer.layouts.master')

@section('title', 'Privacy Policy - Ved Herbs & Ayurveda')

@section('content')
<!-- Breadcrumb Navigation -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <nav class="flex text-sm text-stone-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                    <iconify-icon icon="lucide:home" width="16"></iconify-icon>
                    <span class="ml-2">Home</span>
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                    <span class="ml-2 text-stone-900 font-medium">Privacy Policy</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Privacy Policy Header -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-800 text-sm font-medium mb-6">
            <iconify-icon icon="lucide:shield-check" width="16"></iconify-icon>
            Privacy & Security
        </div>
        <h1 class="text-4xl md:text-5xl font-serif font-semibold text-stone-900 mb-6">
            Privacy Policy
        </h1>
        <p class="text-xl text-stone-600 max-w-3xl mx-auto mb-8">
            Your privacy is extremely important to us. Learn how we protect and handle your personal information.
        </p>
        <div class="text-sm text-stone-500">
            Last Updated: {{ date('F j, Y') }}
        </div>
    </div>

    <!-- Quick Navigation -->
    <div class="sticky top-20 bg-white border-b border-stone-200 py-4 z-10 mb-8">
        <div class="flex overflow-x-auto space-x-4 pb-2 scrollbar-hide">
            <a href="#info-collection" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                Information We Collect
            </a>
            <a href="#info-use" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                How We Use Your Information
            </a>
            <a href="#cookies" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                Cookies & Tracking
            </a>
            <a href="#payment-security" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                Payment Security
            </a>
            <a href="#data-sharing" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                Data Sharing
            </a>
            <a href="#your-rights" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                Your Rights
            </a>
            <a href="#contact" class="flex-shrink-0 text-sm text-stone-600 hover:text-emerald-700 whitespace-nowrap">
                Contact Us
            </a>
        </div>
    </div>

    <!-- Privacy Policy Content -->
    <div class="max-w-4xl mx-auto">
        <!-- Introduction -->
        <div class="mb-12">
            <p class="text-lg text-stone-700 leading-relaxed">
                Welcome to Ved Herbs & Ayurveda. Your privacy is extremely important to us, and we are committed to protecting the personal information you share with us while using our website <strong>www.vedherbsandayurveda.com</strong>.
            </p>
            <p class="text-lg text-stone-700 leading-relaxed mt-4">
                This Privacy Policy explains how we collect, use, store, protect, and disclose your information when you visit or make a purchase from our website.
            </p>
        </div>

        <!-- Information We Collect -->
        <section id="info-collection" class="mb-16 scroll-mt-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:database" width="24" class="text-blue-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">1. Information We Collect</h2>
            </div>
            
            <p class="text-stone-700 mb-6">
                When you visit or interact with our website, we may collect the following types of information:
            </p>
            
            <div class="space-y-8">
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-stone-900 mb-4 flex items-center gap-2">
                        <iconify-icon icon="lucide:user" width="20" class="text-blue-600"></iconify-icon>
                        1.1 Personal Information
                    </h3>
                    <ul class="space-y-2 text-stone-700">
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:check" width="18" class="text-blue-600 mt-0.5"></iconify-icon>
                            <span>Full Name</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:check" width="18" class="text-blue-600 mt-0.5"></iconify-icon>
                            <span>Mobile Number</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:check" width="18" class="text-blue-600 mt-0.5"></iconify-icon>
                            <span>Email Address</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:check" width="18" class="text-blue-600 mt-0.5"></iconify-icon>
                            <span>Billing & Shipping Address</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:check" width="18" class="text-blue-600 mt-0.5"></iconify-icon>
                            <span>Payment details (processed securely via third-party gateways)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:check" width="18" class="text-blue-600 mt-0.5"></iconify-icon>
                            <span>Order history and product preferences</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-stone-50 border border-stone-200 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-stone-900 mb-4 flex items-center gap-2">
                        <iconify-icon icon="lucide:monitor" width="20" class="text-stone-600"></iconify-icon>
                        1.2 Non-Personal Information
                    </h3>
                    <ul class="space-y-2 text-stone-700">
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:circle" width="12" class="text-stone-400 mt-1.5"></iconify-icon>
                            <span>Browser type and device information</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:circle" width="12" class="text-stone-400 mt-1.5"></iconify-icon>
                            <span>IP address</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:circle" width="12" class="text-stone-400 mt-1.5"></iconify-icon>
                            <span>Pages visited and time spent on our website</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <iconify-icon icon="lucide:circle" width="12" class="text-stone-400 mt-1.5"></iconify-icon>
                            <span>Cookies and usage data</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- How We Use Your Information -->
        <section id="info-use" class="mb-16 scroll-mt-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:settings" width="24" class="text-purple-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">2. How We Use Your Information</h2>
            </div>
            
            <p class="text-stone-700 mb-6">
                We use the collected information for the following purposes:
            </p>
            
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white border border-stone-200 rounded-xl p-5 hover:border-purple-300 transition-colors">
                    <iconify-icon icon="lucide:package" width="24" class="text-purple-600 mb-3"></iconify-icon>
                    <h4 class="font-semibold text-stone-900 mb-2">Order Processing</h4>
                    <p class="text-sm text-stone-600">To process and deliver your orders efficiently</p>
                </div>
                
                <div class="bg-white border border-stone-200 rounded-xl p-5 hover:border-purple-300 transition-colors">
                    <iconify-icon icon="lucide:mail" width="24" class="text-purple-600 mb-3"></iconify-icon>
                    <h4 class="font-semibold text-stone-900 mb-2">Order Updates</h4>
                    <p class="text-sm text-stone-600">To communicate order confirmations and shipping updates</p>
                </div>
                
                <div class="bg-white border border-stone-200 rounded-xl p-5 hover:border-purple-300 transition-colors">
                    <iconify-icon icon="lucide:headphones" width="24" class="text-purple-600 mb-3"></iconify-icon>
                    <h4 class="font-semibold text-stone-900 mb-2">Customer Support</h4>
                    <p class="text-sm text-stone-600">To provide customer support and respond to inquiries</p>
                </div>
                
                <div class="bg-white border border-stone-200 rounded-xl p-5 hover:border-purple-300 transition-colors">
                    <iconify-icon icon="lucide:trending-up" width="24" class="text-purple-600 mb-3"></iconify-icon>
                    <h4 class="font-semibold text-stone-900 mb-2">Website Improvement</h4>
                    <p class="text-sm text-stone-600">To improve website functionality and user experience</p>
                </div>
                
                <div class="bg-white border border-stone-200 rounded-xl p-5 hover:border-purple-300 transition-colors">
                    <iconify-icon icon="lucide:megaphone" width="24" class="text-purple-600 mb-3"></iconify-icon>
                    <h4 class="font-semibold text-stone-900 mb-2">Marketing Communications</h4>
                    <p class="text-sm text-stone-600">To send promotional offers, updates, and newsletters (with consent)</p>
                </div>
                
                <div class="bg-white border border-stone-200 rounded-xl p-5 hover:border-purple-300 transition-colors">
                    <iconify-icon icon="lucide:shield" width="24" class="text-purple-600 mb-3"></iconify-icon>
                    <h4 class="font-semibold text-stone-900 mb-2">Security & Fraud Prevention</h4>
                    <p class="text-sm text-stone-600">To prevent fraud, unauthorized transactions, and misuse</p>
                </div>
            </div>
        </section>

        <!-- Cookies & Tracking -->
        <section id="cookies" class="mb-16 scroll-mt-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:cookie" width="24" class="text-amber-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">3. Cookies & Tracking Technologies</h2>
            </div>
            
            <div class="bg-amber-50 border border-amber-100 rounded-xl p-6 mb-6">
                <p class="text-stone-700">
                    Our website uses cookies and similar technologies to:
                </p>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <iconify-icon icon="lucide:bookmark" width="16" class="text-amber-700"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-900 mb-1">Remember Your Preferences</h4>
                        <p class="text-stone-600">Store your language, currency, and other preferences for future visits</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <iconify-icon icon="lucide:zap" width="16" class="text-amber-700"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-900 mb-1">Improve Site Performance</h4>
                        <p class="text-stone-600">Optimize website loading speed and functionality</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <iconify-icon icon="lucide:bar-chart-3" width="16" class="text-amber-700"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-900 mb-1">Analyze User Behavior</h4>
                        <p class="text-stone-600">Understand how visitors interact with our website for improvements</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <iconify-icon icon="lucide:shopping-cart" width="16" class="text-amber-700"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-900 mb-1">Personalized Shopping Experience</h4>
                        <p class="text-stone-600">Show relevant products and recommendations based on your interests</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 p-5 bg-white border border-stone-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <iconify-icon icon="lucide:info" width="20" class="text-amber-600 mt-0.5 flex-shrink-0"></iconify-icon>
                    <div>
                        <p class="text-stone-700">
                            <strong>Note:</strong> You can disable cookies through your browser settings, but some features of the website may not function properly.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Payment Security -->
        <section id="payment-security" class="mb-16 scroll-mt-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:credit-card" width="24" class="text-emerald-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">4. Payment Security</h2>
            </div>
            
            <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-200 rounded-xl p-8 mb-6">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <iconify-icon icon="lucide:lock" width="28" class="text-emerald-700"></iconify-icon>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-3">Your Payment Information is Secure</h3>
                        <p class="text-stone-700">
                            We do not store or process your payment card details directly. All transactions are securely handled by trusted third-party payment gateways that comply with industry security standards.
                        </p>
                        <div class="mt-4 p-4 bg-white rounded-lg border border-emerald-100">
                            <p class="text-sm text-emerald-800 font-medium">
                                <iconify-icon icon="lucide:alert-circle" width="16" class="inline mr-2"></iconify-icon>
                                Ved Herbs & Ayurveda does not have access to your complete card or banking information.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sharing of Information -->
        <section id="data-sharing" class="mb-16 scroll-mt-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:users" width="24" class="text-red-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">5. Sharing of Information</h2>
            </div>
            
            <div class="bg-red-50 border border-red-100 rounded-xl p-6 mb-6">
                <p class="text-lg text-stone-800 font-semibold flex items-center gap-2">
                    <iconify-icon icon="lucide:shield-off" width="20" class="text-red-600"></iconify-icon>
                    We do not sell, trade, or rent your personal information to third parties.
                </p>
            </div>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-stone-900 mb-4">When We May Share Your Information</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 p-4 bg-white border border-stone-200 rounded-lg">
                        <iconify-icon icon="lucide:truck" width="20" class="text-stone-500 mt-0.5 flex-shrink-0"></iconify-icon>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Delivery & Logistics Partners</h4>
                            <p class="text-sm text-stone-600">For order fulfillment and shipping purposes only</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 bg-white border border-stone-200 rounded-lg">
                        <iconify-icon icon="lucide:banknote" width="20" class="text-stone-500 mt-0.5 flex-shrink-0"></iconify-icon>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Payment Gateway Providers</h4>
                            <p class="text-sm text-stone-600">For secure transaction processing</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 bg-white border border-stone-200 rounded-lg">
                        <iconify-icon icon="lucide:scale" width="20" class="text-stone-500 mt-0.5 flex-shrink-0"></iconify-icon>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Legal Authorities</h4>
                            <p class="text-sm text-stone-600">If required by law or to protect our legal rights</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-5 bg-stone-50 border border-stone-200 rounded-xl">
                <p class="text-stone-700">
                    <strong>Important:</strong> All third parties are obligated to maintain confidentiality and data security in compliance with our privacy standards.
                </p>
            </div>
        </section>

        <!-- Data Protection & Security -->
        <section class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:shield" width="24" class="text-blue-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">6. Data Protection & Security</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white border border-blue-100 rounded-xl p-5 text-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                        <iconify-icon icon="lucide:server" width="24" class="text-blue-700"></iconify-icon>
                    </div>
                    <h4 class="font-semibold text-stone-900 mb-2">Secure Servers</h4>
                    <p class="text-sm text-stone-600">Your data is stored on protected servers with restricted access</p>
                </div>
                
                <div class="bg-white border border-blue-100 rounded-xl p-5 text-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                        <iconify-icon icon="lucide:lock" width="24" class="text-blue-700"></iconify-icon>
                    </div>
                    <h4 class="font-semibold text-stone-900 mb-2">Encrypted Communication</h4>
                    <p class="text-sm text-stone-600">All data transmission is encrypted using SSL/TLS technology</p>
                </div>
                
                <div class="bg-white border border-blue-100 rounded-xl p-5 text-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                        <iconify-icon icon="lucide:key" width="24" class="text-blue-700"></iconify-icon>
                    </div>
                    <h4 class="font-semibold text-stone-900 mb-2">Limited Access</h4>
                    <p class="text-sm text-stone-600">Only authorized personnel can access sensitive customer data</p>
                </div>
            </div>
            
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start gap-3">
                    <iconify-icon icon="lucide:alert-triangle" width="24" class="text-blue-600 flex-shrink-0 mt-0.5"></iconify-icon>
                    <div>
                        <h4 class="font-semibold text-stone-900 mb-2">Security Disclaimer</h4>
                        <p class="text-stone-700">
                            We implement strict security measures to protect your personal information. However, no method of transmission over the internet is 100% secure. We strive to protect your data but cannot guarantee absolute security.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Your Rights & Choices -->
        <section id="your-rights" class="mb-16 scroll-mt-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="lucide:clipboard-check" width="24" class="text-green-700"></iconify-icon>
                </div>
                <h2 class="text-3xl font-semibold text-stone-900">7. Your Rights & Choices</h2>
            </div>
            
            <div class="bg-green-50 border border-green-100 rounded-xl p-6 mb-8">
                <p class="text-stone-700 mb-4">
                    You have the right to control your personal information. Here are your key rights:
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:eye" width="16" class="text-green-700"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Access Your Data</h4>
                            <p class="text-sm text-stone-600">Request a copy of the personal data we hold about you</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:edit" width="16" class="text-green-700"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Correct Inaccurate Information</h4>
                            <p class="text-sm text-stone-600">Request correction of any inaccurate or incomplete information</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:trash-2" width="16" class="text-green-700"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Request Data Deletion</h4>
                            <p class="text-sm text-stone-600">Ask us to delete your personal data from our systems</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:bell-off" width="16" class="text-green-700"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-semibold text-stone-900 mb-1">Opt-out of Marketing</h4>
                            <p class="text-sm text-stone-600">Unsubscribe from promotional communications at any time</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-5 bg-white border border-green-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <iconify-icon icon="lucide:mail" width="20" class="text-green-600 mt-0.5 flex-shrink-0"></iconify-icon>
                    <div>
                        <p class="text-stone-700">
                            To exercise these rights, please contact us using the details in the <a href="#contact" class="text-emerald-700 hover:text-emerald-800 font-medium">Contact Us</a> section below.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Third-Party Links -->
        <section class="mb-16">
            <h3 class="text-2xl font-semibold text-stone-900 mb-6">8. Third-Party Links</h3>
            <div class="bg-stone-50 border border-stone-200 rounded-xl p-6">
                <p class="text-stone-700">
                    Our website may contain links to third-party websites. Ved Herbs & Ayurveda is not responsible for the privacy practices or content of those websites. We encourage you to read their privacy policies separately.
                </p>
            </div>
        </section>

        <!-- Children's Privacy -->
        <section class="mb-16">
            <h3 class="text-2xl font-semibold text-stone-900 mb-6">9. Children's Privacy</h3>
            <div class="bg-red-50 border border-red-100 rounded-xl p-6">
                <div class="flex items-center gap-3 mb-4">
                    <iconify-icon icon="lucide:child" width="24" class="text-red-600"></iconify-icon>
                    <h4 class="text-xl font-semibold text-stone-900">Age Restriction</h4>
                </div>
                <p class="text-stone-700">
                    Our website is not intended for children under the age of 18. We do not knowingly collect personal information from minors.
                </p>
            </div>
        </section>

        <!-- Ayurvedic Disclaimer -->
        <section class="mb-16">
            <h3 class="text-2xl font-semibold text-stone-900 mb-6">10. Ayurvedic & Medical Disclaimer</h3>
            <div class="bg-amber-50 border border-amber-100 rounded-xl p-6">
                <div class="flex items-center gap-3 mb-4">
                    <iconify-icon icon="lucide:alert-circle" width="24" class="text-amber-600"></iconify-icon>
                    <h4 class="text-xl font-semibold text-stone-900">Important Notice</h4>
                </div>
                <p class="text-stone-700 mb-4">
                    The information provided on our website is for educational and informational purposes only. Our Ayurvedic products are not intended to diagnose, treat, cure, or prevent any disease.
                </p>
                <div class="bg-white border border-amber-200 rounded-lg p-4">
                    <p class="text-amber-800 font-medium">
                        <iconify-icon icon="lucide:stethoscope" width="18" class="inline mr-2"></iconify-icon>
                        Please consult a qualified healthcare professional before using any product, especially if you are pregnant, nursing, or have a medical condition.
                    </p>
                </div>
            </div>
        </section>

        <!-- Policy Changes -->
        <section class="mb-16">
            <h3 class="text-2xl font-semibold text-stone-900 mb-6">11. Changes to This Privacy Policy</h3>
            <div class="bg-stone-50 border border-stone-200 rounded-xl p-6">
                <p class="text-stone-700 mb-4">
                    Ved Herbs & Ayurveda reserves the right to update or modify this Privacy Policy at any time without prior notice. Changes will be effective immediately upon posting on this page.
                </p>
                <div class="flex items-start gap-3 p-4 bg-white rounded-lg border border-stone-200">
                    <iconify-icon icon="lucide:calendar" width="20" class="text-stone-500 mt-0.5 flex-shrink-0"></iconify-icon>
                    <div>
                        <p class="text-stone-700">
                            <strong>We encourage you to review this policy periodically</strong> to stay informed about how we are protecting your information.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Us -->
        <section id="contact" class="scroll-mt-20">
            <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-200 rounded-2xl p-8">

                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-6">
                        <iconify-icon icon="lucide:mail" width="28" class="text-emerald-700"></iconify-icon>
                    </div>
                    <h3 class="text-2xl font-semibold text-stone-900 mb-4 flex justify-center items-center gap-2">
                        <iconify-icon icon="lucide:contact" width="22" class="text-emerald-700"></iconify-icon>
                        Contact Us
                    </h3>
                    <p class="text-stone-600 max-w-2xl mx-auto">
                        If you have any questions or concerns regarding this Privacy Policy, you may contact us at:
                    </p>
                </div>

                <!-- Contact Cards -->
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Email -->
                    <a href="mailto:support@vedherbsandayurveda.com"
                       class="group bg-white border border-emerald-200 rounded-xl p-5 text-center hover:border-emerald-300 hover:shadow-sm transition-all flex flex-col items-center justify-center h-full">
                        
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mb-4 group-hover:bg-emerald-200 transition-colors">
                            <iconify-icon icon="lucide:mail" width="22" class="text-emerald-700"></iconify-icon>
                        </div>

                        <h4 class="font-semibold text-stone-900 mb-2 flex items-center gap-2">
                            <iconify-icon icon="lucide:at-sign" width="16" class="text-emerald-600"></iconify-icon>
                            Email
                        </h4>

                        <p class="text-sm text-emerald-700 break-all max-w-full">
                            support@vedherbsandayurveda.com
                        </p>
                    </a>

                    <!-- Phone -->
                    <a href="tel:+918866165757"
                       class="group bg-white border border-emerald-200 rounded-xl p-5 text-center hover:border-emerald-300 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-200 transition-colors">
                            <iconify-icon icon="lucide:phone" width="22" class="text-emerald-700"></iconify-icon>
                        </div>
                        <h4 class="font-semibold text-stone-900 mb-2 flex justify-center items-center gap-2">
                            <iconify-icon icon="lucide:message-circle" width="16" class="text-emerald-600"></iconify-icon>
                            Phone / WhatsApp
                        </h4>
                        <p class="text-sm text-emerald-700">+91 8866 16 5757</p>
                    </a>

                    <!-- Website -->
                    <a href="https://www.vedherbsandayurveda.com" target="_blank"
                       class="group bg-white border border-emerald-200 rounded-xl p-5 text-center hover:border-emerald-300 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-200 transition-colors">
                            <iconify-icon icon="lucide:globe" width="22" class="text-emerald-700"></iconify-icon>
                        </div>
                        <h4 class="font-semibold text-stone-900 mb-2 flex justify-center items-center gap-2">
                            <iconify-icon icon="lucide:external-link" width="16" class="text-emerald-600"></iconify-icon>
                            Website
                        </h4>
                        <p class="text-sm text-emerald-700">www.vedherbsandayurveda.com</p>
                    </a>
                </div>

                <!-- Footer Info -->
                <div class="mt-8 pt-8 border-t border-emerald-200">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                        <!-- Business Hours -->
                        <div class="flex items-center gap-3">
                            <iconify-icon icon="lucide:calendar-days" width="20" class="text-emerald-600"></iconify-icon>
                            <div>
                                <p class="text-sm font-medium text-stone-900">Business Hours</p>
                                <p class="text-sm text-stone-600">Monday to Saturday</p>
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="text-center md:text-right">
                            <p class="text-sm text-stone-600 flex items-center justify-center md:justify-end gap-2">
                                <iconify-icon icon="lucide:refresh-ccw" width="14" class="text-emerald-600"></iconify-icon>
                                Last Updated: {{ date('F j, Y') }}
                            </p>
                            <p class="text-xs text-stone-500 mt-1">
                                © {{ date('Y') }} Ved Herbs & Ayurveda. All rights reserved.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- Back to Top -->
        <div class="mt-12 text-center">
            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-stone-600 hover:text-emerald-700 transition-colors">
                <iconify-icon icon="lucide:arrow-up" width="16"></iconify-icon>
                Back to Top
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Highlight current section in navigation
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.sticky a[href^="#"]');
    
    function highlightNavLink() {
        let scrollPosition = window.scrollY + 150;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('text-emerald-700', 'font-medium');
                    link.classList.add('text-stone-600');
                    
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.remove('text-stone-600');
                        link.classList.add('text-emerald-700', 'font-medium');
                    }
                });
            }
        });
    }
    
    window.addEventListener('scroll', highlightNavLink);
    highlightNavLink(); // Initial call
});
</script>
@endpush