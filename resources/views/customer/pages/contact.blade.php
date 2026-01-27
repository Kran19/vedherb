{{-- C:\laravel-projects\ved-ayurvedic\resources\views\customer\pages\contact.blade.php --}}
@extends('customer.layouts.master')

@section('title', 'Contact Us - Ved Ayurvedic')
@section('description', 'Contact Ved Ayurvedic for wellness consultations, product inquiries, or Ayurvedic guidance. Our experts are here to help you.')

@push('styles')
<style>
    /* Contact Page Specific Styles */
    .contact-hero {
        background: linear-gradient(rgba(20, 83, 45, 0.95), rgba(6, 95, 70, 0.9)), url('https://images.unsplash.com/photo-1543362906-acfc16c67564?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .contact-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(5, 150, 105, 0.1);
        transition: all 0.3s ease;
    }
    
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(5, 150, 105, 0.1);
        border-color: rgba(5, 150, 105, 0.2);
    }
    
    .form-input {
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .form-input:focus {
        background: white;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .map-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    /* Form success/error styles */
    .form-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        border-left: 4px solid #059669;
    }
    
    .form-error {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        border-left: 4px solid #dc2626;
    }
    
    /* Loading animation for form submission */
    .form-loading {
        position: relative;
        opacity: 0.7;
        pointer-events: none;
    }
    
    .form-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 24px;
        height: 24px;
        border: 2px solid rgba(5, 150, 105, 0.2);
        border-top-color: #059669;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }
    
    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    /* WhatsApp button animation */
    .whatsapp-pulse {
        animation: pulse-green 2s infinite;
    }
    
    @keyframes pulse-green {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .contact-hero {
            background-attachment: scroll;
        }
        
        .map-container {
            height: 300px;
        }
    }
    
    /* Opening hours styling */
    .hours-item {
        transition: all 0.3s ease;
    }
    
    .hours-item:hover {
        background: #f0fdf4;
        transform: translateX(5px);
    }
    
    .current-time {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
    }
    
    /* Custom checkbox for newsletter */
    .checkbox-custom {
        width: 18px;
        height: 18px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    input:checked + .checkbox-custom {
        background-color: #059669;
        border-color: #059669;
    }
    
    input:checked + .checkbox-custom svg {
        display: block;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="contact-hero py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/20 to-emerald-900/30"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm mb-6">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>We're Here to Help</span>
            </div>
            
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-medium text-white mb-4 md:mb-6">
                Get in Touch
            </h1>
            
            <p class="text-lg sm:text-xl text-emerald-100 mb-8 max-w-2xl mx-auto leading-relaxed">
                Have questions about Ayurveda or our products? Our wellness experts are ready to guide you on your health journey.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="#contact-form" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-emerald-800 font-medium hover:bg-emerald-50 transition-all shadow-lg hover:shadow-xl active:scale-[0.98]">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    Send Message
                </a>
                <a href="tel:+911234567890" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-emerald-800/50 backdrop-blur-sm text-white font-medium border border-emerald-700 hover:bg-emerald-700/50 transition-all hover:shadow-lg active:scale-[0.98]">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                    Call Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="py-12 md:py-16 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-6 md:gap-8">
            <!-- Address Card -->
            <div class="contact-card rounded-2xl p-6 md:p-8">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-6">
                    <i data-lucide="map-pin" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-semibold text-stone-900 mb-3">Visit Our Center</h3>
                <p class="text-stone-600 mb-4">
                    Ved Herbs & Ayurveda Wellness Center<br>
                    123 Ayurveda Marg, Near Ganga Ghat<br>
                    Rishikesh, Uttarakhand 249201
                </p>
                <a href="#map" class="inline-flex items-center gap-2 text-emerald-700 font-medium text-sm hover:text-emerald-800">
                    <i data-lucide="navigation" class="w-4 h-4"></i>
                    Get Directions
                </a>
            </div>
            
            <!-- Contact Card -->
            <div class="contact-card rounded-2xl p-6 md:p-8">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-6">
                    <i data-lucide="phone" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-semibold text-stone-900 mb-3">Call or WhatsApp</h3>
                <div class="space-y-3 mb-4">
                    <a href="tel:+911234567890" class="block text-lg font-medium text-stone-900 hover:text-emerald-700">
                        +91 12345 67890
                    </a>
                    <a href="tel:+911234567891" class="block text-lg font-medium text-stone-900 hover:text-emerald-700">
                        +91 12345 67891
                    </a>
                </div>
                <a href="https://wa.me/911234567890" target="_blank" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#25D366] text-white font-medium text-sm hover:bg-[#128C7E] transition-all whatsapp-pulse">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    Chat on WhatsApp
                </a>
            </div>
            
            <!-- Hours Card -->
            <div class="contact-card rounded-2xl p-6 md:p-8">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-6">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-semibold text-stone-900 mb-3">Opening Hours</h3>
                <div class="space-y-3">
                    <div class="hours-item flex justify-between p-2 rounded-lg">
                        <span class="day text-stone-700">Monday - Friday</span>
                        <span class="text-stone-900 font-medium">9:00 AM - 8:00 PM</span>
                    </div>
                    <div class="hours-item flex justify-between p-2 rounded-lg">
                        <span class="day text-stone-700">Saturday</span>
                        <span class="text-stone-900 font-medium">10:00 AM - 6:00 PM</span>
                    </div>
                    <div class="hours-item flex justify-between p-2 rounded-lg">
                        <span class="day text-stone-700">Sunday</span>
                        <span class="text-stone-900 font-medium">11:00 AM - 5:00 PM</span>
                    </div>
                </div>
                <p class="text-sm text-stone-500 mt-4 italic">
                    * Consultation by appointment only
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map -->
<section class="py-12 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Contact Form -->
            <div id="contact-form">
                <div class="max-w-lg">
                    <div class="mb-10">
                        <h2 class="text-3xl md:text-4xl font-serif font-medium text-stone-900 mb-4">
                            Send Us a Message
                        </h2>
                        <p class="text-stone-600">
                            Fill out the form below and our Ayurvedic experts will get back to you within 24 hours.
                        </p>
                    </div>
                    
                    <form id="contactForm" class="space-y-6" method="POST">
                        @csrf
                        <!-- Form Status Messages -->
                        <div id="form-status" class="hidden p-4 rounded-lg"></div>
                        
                        @if(session('success'))
                        <div class="form-success p-4 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700">
                                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-emerald-900">Message Sent Successfully!</h4>
                                    <p class="text-emerald-800 text-sm mt-1">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($errors->any())
                        <div class="form-error p-4 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-700">
                                    <i data-lucide="alert-circle" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-red-900">Please fix the following errors:</h4>
                                    <ul class="text-red-800 text-sm mt-1 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-stone-700 mb-2">
                                    Full Name *
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       required
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-stone-300 form-input focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                       placeholder="Enter your full name">
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-stone-700 mb-2">
                                    Email Address *
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required
                                       value="{{ old('email') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-stone-300 form-input focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                       placeholder="your.email@example.com">
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-stone-700 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-stone-300 form-input focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                   placeholder="+91 98765 43210">
                            @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-stone-700 mb-2">
                                Subject *
                            </label>
                            <select id="subject" 
                                    name="subject" 
                                    required
                                    class="w-full px-4 py-3 rounded-lg border border-stone-300 form-input focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                                <option value="" disabled selected>Select a subject</option>
                                <option value="product-inquiry" {{ old('subject') == 'product-inquiry' ? 'selected' : '' }}>Product Inquiry</option>
                                <option value="order-status" {{ old('subject') == 'order-status' ? 'selected' : '' }}>Order Status</option>
                                <option value="ayurvedic-consultation" {{ old('subject') == 'ayurvedic-consultation' ? 'selected' : '' }}>Ayurvedic Consultation</option>
                                <option value="wholesale-inquiry" {{ old('subject') == 'wholesale-inquiry' ? 'selected' : '' }}>Wholesale Inquiry</option>
                                <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-stone-700 mb-2">
                                Your Message *
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5"
                                      required
                                      class="w-full px-4 py-3 rounded-lg border border-stone-300 form-input focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                      placeholder="Tell us how we can help you...">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="newsletter" 
                                   name="newsletter"
                                   value="1"
                                   {{ old('newsletter') ? 'checked' : '' }}
                                   class="sr-only">
                            <label for="newsletter" class="flex items-center cursor-pointer">
                                <span class="checkbox-custom mr-3">
                                    <i data-lucide="check" class="w-3 h-3 text-white hidden"></i>
                                </span>
                                <span class="text-sm text-stone-600">
                                    Subscribe to our wellness newsletter for Ayurvedic tips and exclusive offers
                                </span>
                            </label>
                        </div>
                        
                        <button type="submit"
                                class="w-full md:w-auto px-8 py-4 rounded-full bg-emerald-700 text-white font-medium hover:bg-emerald-800 transition-all shadow-lg hover:shadow-xl active:scale-[0.98] flex items-center justify-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Map -->
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55251.37709964616!2d78.26774920951815!3d30.086946026507446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39093e67cf93f111%3A0xcc78804a6f941bfe!2sRishikesh%2C%20Uttarakhand!5e0!3m2!1sen!2sin!4v1639575274429!5m2!1sen!2sin" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <!-- Ayurvedic Consultation -->
                <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-stone-900 mb-2">
                                Free Ayurvedic Consultation
                            </h3>
                            <p class="text-stone-600 mb-4">
                                Book a complimentary consultation with our certified Ayurvedic practitioners to understand your Prakriti (body type) and get personalized wellness recommendations.
                            </p>
                            <a 
                               class="inline-flex items-center gap-2 text-emerald-700 font-medium hover:text-emerald-800">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                Book Your Consultation
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Emergency Contact -->
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                            <i data-lucide="alert-circle" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-stone-900 mb-2">
                                Emergency Support
                            </h3>
                            <p class="text-stone-600 mb-4">
                                For urgent queries related to product usage or adverse effects, please call our emergency helpline available 24/7.
                            </p>
                            <a href="tel:+9118001234567" 
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100 text-amber-800 font-medium hover:bg-amber-200 transition-all">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                Emergency: 1800-123-4567
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- CTA Section -->
<section class="py-16 md:py-24 bg-emerald-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('https://www.transparenttextures.com/patterns/asanoha-400px.png');"></div>
    </div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-medium mb-6">
            Start Your Wellness Journey Today
        </h2>
        <p class="text-lg text-emerald-100 mb-10 max-w-2xl mx-auto">
            Join thousands of satisfied customers who have transformed their health with authentic Ayurveda.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('customer.products.shop') }}" 
               class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-white text-emerald-900 font-medium hover:bg-emerald-50 transition-all shadow-xl hover:shadow-2xl active:scale-[0.98]">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                Shop Ayurvedic Products
            </a>
            <a href="tel:+911234567890" 
               class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-emerald-800 text-white font-medium border border-emerald-700 hover:bg-emerald-700 transition-all hover:shadow-xl active:scale-[0.98]">
                <i data-lucide="phone" class="w-4 h-4"></i>
                Call for Consultation
            </a>
        </div>
        
        <div class="mt-12 pt-8 border-t border-emerald-800">
            <div class="flex flex-wrap justify-center gap-6 text-emerald-200 text-sm">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    <span>100% Secure Payments</span>
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="truck" class="w-4 h-4"></i>
                    <span>Free Shipping over ₹999</span>
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    <span>24/7 Customer Support</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (window.lucide) {
        lucide.createIcons();
    }
    
    // FAQ toggle functionality
    window.toggleFAQ = function(index) {
        const answer = document.querySelectorAll('.faq-answer')[index];
        const icon = document.querySelectorAll('.faq-question i')[index];
        
        if (answer && icon) {
            answer.classList.toggle('hidden');
            icon.style.transform = answer.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    };
    
    // Form submission handling (AJAX version - optional)
    const contactForm = document.getElementById('contactForm');
    const formStatus = document.getElementById('form-status');
    
    if (contactForm) {
        // Remove the async submit handler since we're using Laravel form submission
        // The form will submit normally and Laravel will handle validation
        
        // Optional: You can add AJAX submission here if desired
        // contactForm.addEventListener('submit', async function(e) {
        //     e.preventDefault();
        //     // AJAX form submission code here
        // });
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Dynamic current day highlight
    const today = new Date().toLocaleDateString('en-US', { weekday: 'long' });
    document.querySelectorAll('.hours-item').forEach(item => {
        if (item.querySelector('.day').textContent === today) {
            item.classList.add('current-time');
        }
    });
    
    // WhatsApp button animation
    const whatsappBtn = document.querySelector('.whatsapp-pulse');
    if (whatsappBtn) {
        whatsappBtn.addEventListener('mouseenter', () => {
            whatsappBtn.style.animationPlayState = 'paused';
        });
        
        whatsappBtn.addEventListener('mouseleave', () => {
            whatsappBtn.style.animationPlayState = 'running';
        });
    }
    
    // Form input animations
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-emerald-200');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-emerald-200');
        });
    });
    
    // Auto-hide success/error messages after 5 seconds
    setTimeout(() => {
        const successDiv = document.querySelector('.form-success');
        const errorDiv = document.querySelector('.form-error');
        
        if (successDiv) {
            successDiv.style.opacity = '0';
            successDiv.style.transition = 'opacity 0.5s';
            setTimeout(() => {
                if (successDiv.parentNode) {
                    successDiv.parentNode.removeChild(successDiv);
                }
            }, 500);
        }
        
        if (errorDiv) {
            errorDiv.style.opacity = '0';
            errorDiv.style.transition = 'opacity 0.5s';
            setTimeout(() => {
                if (errorDiv.parentNode) {
                    errorDiv.parentNode.removeChild(errorDiv);
                }
            }, 500);
        }
    }, 5000);
});
</script>
@endpush