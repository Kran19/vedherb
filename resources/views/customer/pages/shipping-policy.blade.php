@extends('customer.layouts.master')

@section('title', 'Shipping Policy - Ved Herbs & Ayurveda')

@push('styles')
<style>
    /* Shipping Policy Styles */
    .shipping-hero {
        background: linear-gradient(rgba(20, 83, 45, 0.95), rgba(6, 95, 70, 0.9)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .policy-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .policy-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(5, 150, 105, 0.1);
        border-color: rgba(5, 150, 105, 0.2);
    }
    
    .policy-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, #059669, #10b981);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .policy-card:hover::before {
        opacity: 1;
    }
    
    .timeline-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #059669;
        border: 4px solid #d1fae5;
        position: relative;
        flex-shrink: 0;
    }
    
    .timeline-line {
        position: absolute;
        left: 50%;
        top: 100%;
        transform: translateX(-50%);
        width: 2px;
        height: 40px;
        background: #d1fae5;
    }
    
    .shipping-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        background: #f0fdf4;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .info-box {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border-left: 4px solid #059669;
    }
    
    .warning-box {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-left: 4px solid #d97706;
    }
    
    .shipping-flow {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        padding: 2rem 0;
    }
    
    .shipping-flow::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: #e5e7eb;
        z-index: 1;
    }
    
    .flow-step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }
    
    .step-circle {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: white;
        border: 3px solid #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: #059669;
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .shipping-hero {
            background-attachment: scroll;
            padding-top: 4rem !important;
            padding-bottom: 4rem !important;
        }
        
        .shipping-hero h1 {
            font-size: 2.25rem !important;
            line-height: 2.5rem !important;
        }
        
        .policy-grid {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }
        
        .shipping-flow {
            flex-direction: column;
            gap: 2rem;
        }
        
        .shipping-flow::before {
            display: none;
        }
        
        .flow-step {
            width: 100%;
        }
        
        .step-circle {
            margin-bottom: 0.5rem;
        }
        
        .info-box, .warning-box {
            padding: 1rem !important;
        }
    }
    
    @media (max-width: 640px) {
        .timeline-dot {
            width: 20px;
            height: 20px;
            border-width: 3px;
        }
        
        .timeline-line {
            height: 20px;
        }
        
        .shipping-badge {
            font-size: 0.7rem;
            padding: 3px 10px;
        }
    }
    
    /* Animation for timeline items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .timeline-item {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }
    
    .timeline-item:nth-child(1) { animation-delay: 0.1s; }
    .timeline-item:nth-child(2) { animation-delay: 0.2s; }
    .timeline-item:nth-child(3) { animation-delay: 0.3s; }
    .timeline-item:nth-child(4) { animation-delay: 0.4s; }
    .timeline-item:nth-child(5) { animation-delay: 0.5s; }
    .timeline-item:nth-child(6) { animation-delay: 0.6s; }
    .timeline-item:nth-child(7) { animation-delay: 0.7s; }
    
    /* FAQ accordion */
    .faq-item {
        border-bottom: 1px solid #e5e7eb;
    }
    
    .faq-question {
        cursor: pointer;
        padding: 1.25rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .faq-question:hover {
        color: #059669;
    }
    
    .faq-answer {
        padding: 0 0 1.25rem;
        color: #4b5563;
        line-height: 1.6;
    }
    
    .faq-icon {
        transition: transform 0.3s ease;
    }
    
    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="shipping-hero py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/20 to-emerald-900/30"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm mb-6">
                <iconify-icon icon="lucide:package" width="16" height="16"></iconify-icon>
                <span>Trusted Delivery Across India</span>
            </div>
            
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-medium text-white mb-4 md:mb-6">
                Shipping Policy
            </h1>
            
            <p class="text-lg sm:text-xl text-emerald-100 mb-8 max-w-2xl mx-auto leading-relaxed">
                Clear, transparent, and reliable shipping for your Ayurvedic wellness journey. Delivered with care.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white">
                    <iconify-icon icon="lucide:clock" width="16" height="16"></iconify-icon>
                    <span>24-48hr Processing</span>
                </div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white">
                    <iconify-icon icon="lucide:shield-check" width="16" height="16"></iconify-icon>
                    <span>Discreet Packaging</span>
                </div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white">
                    <iconify-icon icon="lucide:truck" width="16" height="16"></iconify-icon>
                    <span>Pan-India Delivery</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shipping Timeline -->
<section class="py-12 md:py-16 bg-stone-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-2xl md:text-3xl font-serif font-medium text-stone-900 mb-4">
                Your Order Journey
            </h2>
            <p class="text-stone-600 max-w-2xl mx-auto">
                From order placement to doorstep delivery, here's how we ensure your Ayurvedic products reach you safely
            </p>
        </div>
        
        <div class="shipping-flow">
            <!-- Step 1 -->
            <div class="flow-step">
                <div class="step-circle">
                    <iconify-icon icon="lucide:shopping-cart" width="24" height="24"></iconify-icon>
                </div>
                <div class="text-sm font-medium text-stone-900">Order Placed</div>
                <div class="text-xs text-stone-500 mt-1">Instant Confirmation</div>
            </div>
            
            <!-- Step 2 -->
            <div class="flow-step">
                <div class="step-circle">
                    <iconify-icon icon="lucide:package-check" width="24" height="24"></iconify-icon>
                </div>
                <div class="text-sm font-medium text-stone-900">Processing</div>
                <div class="text-xs text-stone-500 mt-1">24-48 Hours</div>
            </div>
            
            <!-- Step 3 -->
            <div class="flow-step">
                <div class="step-circle">
                    <iconify-icon icon="lucide:truck" width="24" height="24"></iconify-icon>
                </div>
                <div class="text-sm font-medium text-stone-900">Dispatched</div>
                <div class="text-xs text-stone-500 mt-1">Tracking Shared</div>
            </div>
            
            <!-- Step 4 -->
            <div class="flow-step">
                <div class="step-circle">
                    <iconify-icon icon="lucide:home" width="24" height="24"></iconify-icon>
                </div>
                <div class="text-sm font-medium text-stone-900">Delivered</div>
                <div class="text-xs text-stone-500 mt-1">3-7 Business Days</div>
            </div>
        </div>
    </div>
</section>

<!-- Main Policy Content -->
<section class="py-12 md:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
            <!-- Left Column - Main Content -->
            <div class="lg:col-span-2">
                <!-- Introduction -->
                <div class="mb-10">
                    <h2 class="text-2xl md:text-3xl font-serif font-medium text-stone-900 mb-6">
                        Shipping Terms & Conditions
                    </h2>
                    <p class="text-stone-600 mb-6">
                        At Ved Herbs & Ayurveda, we are committed to ensuring your Ayurvedic wellness products reach you safely and promptly. Our shipping policy is designed to provide clarity and transparency throughout the delivery process.
                    </p>
                </div>
                
                <!-- Policy Timeline -->
                <div class="space-y-6 mb-12">
                    <!-- Item 1 -->
                    <div class="timeline-item">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line"></div>
                            </div>
                            <div class="policy-card p-6 flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-semibold text-stone-900">Shipping Coverage</h3>
                                    <span class="shipping-badge">
                                        <iconify-icon icon="lucide:map-pin" width="12" height="12"></iconify-icon>
                                        Pan-India
                                    </span>
                                </div>
                                <p class="text-stone-600">
                                    Ved Herbs & Ayurveda ships products across India through trusted courier partners like Delhivery, BlueDart, and India Post for maximum reach and reliability.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="timeline-item">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line"></div>
                            </div>
                            <div class="policy-card p-6 flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-semibold text-stone-900">Order Processing</h3>
                                    <span class="shipping-badge">
                                        <iconify-icon icon="lucide:clock" width="12" height="12"></iconify-icon>
                                        24-48 Hours
                                    </span>
                                </div>
                                <p class="text-stone-600">
                                    All orders are processed within 24–48 working hours after order confirmation. Orders placed on Sundays or public holidays are processed on the next working day.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="timeline-item">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line"></div>
                            </div>
                            <div class="policy-card p-6 flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-semibold text-stone-900">Delivery Timeline</h3>
                                    <span class="shipping-badge">
                                        <iconify-icon icon="lucide:calendar" width="12" height="12"></iconify-icon>
                                        3-7 Days
                                    </span>
                                </div>
                                <p class="text-stone-600">
                                    Estimated delivery time is 3–7 business days, depending on the delivery location. Delivery timelines may vary for remote or rural areas and may extend during festivals, sales, or high-demand periods.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="timeline-item">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line"></div>
                            </div>
                            <div class="policy-card p-6 flex-1">
                                <h3 class="text-lg font-semibold text-stone-900 mb-3">Tracking & Communication</h3>
                                <p class="text-stone-600 mb-4">
                                    Customers will receive a shipment confirmation message/email once the order is dispatched. A tracking number will be shared to monitor shipment status through our website or courier partner's portal.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 5 -->
                    <div class="timeline-item">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line"></div>
                            </div>
                            <div class="policy-card p-6 flex-1">
                                <h3 class="text-lg font-semibold text-stone-900 mb-3">Shipping Charges</h3>
                                <p class="text-stone-600 mb-4">
                                    Shipping charges, if applicable, will be clearly mentioned at checkout. Free shipping may be offered on selected products or during promotional offers. Shipping charges are non-refundable once the order is dispatched.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 6 -->
                    <div class="timeline-item">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line last:hidden"></div>
                            </div>
                            <div class="policy-card p-6 flex-1">
                                <h3 class="text-lg font-semibold text-stone-900 mb-3">Delivery Process</h3>
                                <p class="text-stone-600 mb-4">
                                    Cash on Delivery (COD) is available in selected locations only. Delivery confirmation may require OTP or signature as per courier norms. Tampered or opened packages should not be accepted from the courier.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Important Information Boxes -->
                <div class="space-y-6 mb-12">
                    <div class="info-box p-6 rounded-lg">
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="lucide:info" width="20" height="20" class="text-emerald-700 mt-0.5"></iconify-icon>
                            <div>
                                <h4 class="font-semibold text-emerald-900 mb-2">Important Information</h4>
                                <ul class="text-emerald-800 space-y-2">
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:check-circle" width="16" height="16" class="text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>Provide accurate contact and address details while placing an order</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:check-circle" width="16" height="16" class="text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>Multiple products in a single order may be shipped separately</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:check-circle" width="16" height="16" class="text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>We ensure discreet packaging for all Ayurveda and wellness products</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="warning-box p-6 rounded-lg">
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="lucide:alert-triangle" width="20" height="20" class="text-amber-700 mt-0.5"></iconify-icon>
                            <div>
                                <h4 class="font-semibold text-amber-900 mb-2">Important Points to Note</h4>
                                <ul class="text-amber-800 space-y-2">
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:x-circle" width="16" height="16" class="text-amber-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>Incorrect or incomplete shipping address may result in delivery failure</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:x-circle" width="16" height="16" class="text-amber-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>We do not ship to P.O. Box addresses</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:x-circle" width="16" height="16" class="text-amber-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>International shipping is currently not available unless specifically mentioned</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:x-circle" width="16" height="16" class="text-amber-600 mt-0.5 flex-shrink-0"></iconify-icon>
                                        <span>Orders once shipped cannot be cancelled</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Delivery & Damage Policy -->
                <div class="grid md:grid-cols-2 gap-6 mb-12">
                    <div class="policy-card p-6">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-4">
                            <iconify-icon icon="lucide:shield-alert" width="24" height="24"></iconify-icon>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 mb-3">Damaged Goods Policy</h3>
                        <p class="text-stone-600">
                            If a package is damaged during transit, customers must inform us within 24 hours of delivery with clear photographs. Tampered or opened packages should not be accepted from the courier.
                        </p>
                    </div>
                    
                    <div class="policy-card p-6">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-4">
                            <iconify-icon icon="lucide:refresh-cw" width="24" height="24"></iconify-icon>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 mb-3">Failed Deliveries</h3>
                        <p class="text-stone-600">
                            Delivery attempts are limited as per courier company policy. If delivery fails repeatedly, the order may be cancelled automatically. Orders returned due to non-availability may not be re-shipped.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Quick Info -->
            <div class="lg:col-span-1">
                <!-- Quick Summary Card -->
                <div class="sticky top-24">
                    <div class="policy-card p-6 mb-6">
                        <h3 class="text-lg font-semibold text-stone-900 mb-4">Quick Summary</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-stone-600">Processing Time</span>
                                <span class="font-medium text-emerald-700">24-48 Hours</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-stone-600">Delivery Time</span>
                                <span class="font-medium text-emerald-700">3-7 Business Days</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-stone-600">Shipping Coverage</span>
                                <span class="font-medium text-emerald-700">Pan-India</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-stone-600">COD Available</span>
                                <span class="font-medium text-emerald-700">Selected Areas</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Support Card -->
                    <div class="policy-card p-6">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-4">
                            <iconify-icon icon="lucide:headphones" width="24" height="24"></iconify-icon>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 mb-3">Need Help?</h3>
                        
                        <div class="space-y-3">
                            <a href="tel:+911234567890" 
                               class="inline-flex items-center gap-2 text-emerald-700 font-medium hover:text-emerald-800">
                                <iconify-icon icon="lucide:phone" width="16" height="16"></iconify-icon>
                                +91 12345 67890
                            </a>
                            <a href="mailto:shipping@vedherbs.com" 
                               class="inline-flex items-center gap-2 text-emerald-700 font-medium hover:text-emerald-800">
                                <iconify-icon icon="lucide:mail" width="16" height="16"></iconify-icon>
                                shipping@vedherbs.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FAQ Section -->
        <div class="mt-16 md:mt-20">
            <h2 class="text-2xl md:text-3xl font-serif font-medium text-stone-900 mb-8 text-center">
                Frequently Asked Questions
            </h2>
            
            <div class="max-w-3xl mx-auto">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(1)">
                        <span class="font-medium text-stone-900">Can I change my shipping address after placing an order?</span>
                        <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-stone-400 faq-icon"></iconify-icon>
                    </div>
                    <div class="faq-answer hidden" id="faq-answer-1">
                        Address change requests will not be accepted after order dispatch. Please ensure your shipping address is correct before confirming your order.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(2)">
                        <span class="font-medium text-stone-900">Do you offer international shipping?</span>
                        <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-stone-400 faq-icon"></iconify-icon>
                    </div>
                    <div class="faq-answer hidden" id="faq-answer-2">
                        International shipping is currently not available unless specifically mentioned for certain products or promotional offers.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(3)">
                        <span class="font-medium text-stone-900">What happens if I'm not available during delivery?</span>
                        <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-stone-400 faq-icon"></iconify-icon>
                    </div>
                    <div class="faq-answer hidden" id="faq-answer-3">
                        The courier will make 2-3 delivery attempts. If unsuccessful, the package will be returned to us and the order may be cancelled. Shipping charges are non-refundable in such cases.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(4)">
                        <span class="font-medium text-stone-900">Are shipping charges refundable?</span>
                        <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-stone-400 faq-icon"></iconify-icon>
                    </div>
                    <div class="faq-answer hidden" id="faq-answer-4">
                        Shipping charges are non-refundable once the order is dispatched, except in cases where the return is initiated due to our error or damaged goods.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final Note -->
<section class="py-12 md:py-16 bg-emerald-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-800 text-sm font-medium mb-6">
            <iconify-icon icon="lucide:alert-circle" width="16" height="16"></iconify-icon>
            Policy Update Notice
        </div>
        
        <h3 class="text-xl md:text-2xl font-serif font-medium text-stone-900 mb-4">
            Policy Updates
        </h3>
        
        <p class="text-stone-600 mb-6 max-w-2xl mx-auto">
            Ved Herbs & Ayurveda reserves the right to update the shipping policy at any time without prior notice. Any changes will be reflected on this page immediately.
        </p>
        
        <div class="text-sm text-stone-500">
            <p>Last Updated: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ toggle functionality
    window.toggleFAQ = function(index) {
        const answer = document.getElementById(`faq-answer-${index}`);
        const item = answer.closest('.faq-item');
        const icon = item.querySelector('.faq-icon');
        
        answer.classList.toggle('hidden');
        item.classList.toggle('active');
    };
    
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
    
    // Add hover effects to policy cards
    document.querySelectorAll('.policy-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            // Optional: Add any specific hover effects here
        });
    });
    
    // Add animation to timeline items as they come into view
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.timeline-item').forEach(item => {
        observer.observe(item);
    });
});
</script>
@endpush