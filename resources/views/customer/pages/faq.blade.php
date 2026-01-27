@extends('customer.layouts.master')

@section('title', 'Frequently Asked Questions - Ved Herbs & Ayurveda')

@push('styles')
<style>
    /* FAQ Page Styles - Professional Design */
    :root {
        --emerald-950: #022c22;
        --emerald-900: #064e3b;
        --emerald-800: #065f46;
        --emerald-700: #047857;
        --emerald-600: #059669;
        --emerald-500: #10b981;
        --emerald-400: #34d399;
        --emerald-300: #6ee7b7;
        --emerald-200: #a7f3d0;
        --emerald-100: #d1fae5;
        --emerald-50: #ecfdf5;
    }
    
    .faq-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    /* Header Section */
    .faq-hero {
        text-align: center;
        margin: 40px 0 60px;
        padding: 60px 20px;
        background: linear-gradient(135deg, var(--emerald-50) 0%, var(--emerald-100) 100%);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .faq-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%2310b981" opacity="0.05"><path d="M0,0 L100,0 L100,100 Z"/></svg>');
        background-size: cover;
    }
    
    .faq-hero h1 {
        color: var(--emerald-950);
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
        position: relative;
    }
    
    .hero-subtitle {
        color: var(--emerald-700);
        font-size: 1.3rem;
        max-width: 800px;
        margin: 0 auto 30px;
        line-height: 1.6;
        position: relative;
    }
    
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 40px;
        flex-wrap: wrap;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        display: block;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--emerald-600);
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: var(--emerald-700);
        font-weight: 500;
        margin-top: 5px;
    }
    
    /* Search Section */
    .faq-search-container {
        max-width: 800px;
        margin: 40px auto 60px;
    }
    
    .faq-search {
        position: relative;
    }
    
    .faq-search input {
        width: 100%;
        padding: 20px 60px 20px 30px;
        border: 2px solid var(--emerald-100);
        border-radius: 15px;
        font-size: 1.1rem;
        outline: none;
        transition: all 0.3s ease;
        background: white;
        color: var(--emerald-950);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .faq-search input:focus {
        border-color: var(--emerald-500);
        box-shadow: 0 4px 30px rgba(16, 185, 129, 0.15);
    }
    
    .search-icon {
        position: absolute;
        right: 25px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--emerald-400);
        font-size: 1.2rem;
    }
    
    .search-hint {
        text-align: center;
        color: var(--emerald-600);
        font-size: 0.9rem;
        margin-top: 10px;
    }
    
    /* Quick Links */
    .quick-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 50px 0;
    }
    
    .quick-link-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        text-decoration: none;
        color: var(--emerald-800);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .quick-link-card:hover {
        transform: translateY(-5px);
        border-color: var(--emerald-300);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.1);
        color: var(--emerald-950);
    }
    
    .quick-link-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }
    
    .quick-link-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    
    .quick-link-count {
        font-size: 0.85rem;
        color: var(--emerald-600);
        background: var(--emerald-50);
        padding: 3px 10px;
        border-radius: 20px;
        display: inline-block;
    }
    
    /* FAQ Categories */
    .faq-categories-nav {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 60px;
        padding: 25px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--emerald-100);
    }
    
    .category-nav-btn {
        background: var(--emerald-50);
        border: 2px solid transparent;
        padding: 14px 28px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        color: var(--emerald-800);
        transition: all 0.3s ease;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .category-nav-btn:hover {
        background: var(--emerald-100);
        transform: translateY(-2px);
        border-color: var(--emerald-200);
    }
    
    .category-nav-btn.active {
        background: linear-gradient(135deg, var(--emerald-500) 0%, var(--emerald-600) 100%);
        color: white;
        border-color: var(--emerald-500);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    }
    
    .category-icon-nav {
        font-size: 1.2rem;
    }
    
    /* FAQ Category Sections */
    .faq-category {
        margin-bottom: 50px;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--emerald-100);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .faq-category:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 40px rgba(16, 185, 129, 0.08);
    }
    
    .category-header {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 25px;
        border-bottom: 2px solid var(--emerald-100);
    }
    
    .category-icon-main {
        font-size: 2.5rem;
        margin-right: 20px;
        color: var(--emerald-500);
        background: var(--emerald-50);
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .category-title-wrapper {
        flex: 1;
    }
    
    .category-title {
        color: var(--emerald-950);
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 5px 0;
    }
    
    .category-description {
        color: var(--emerald-600);
        font-size: 1.1rem;
        margin: 0;
    }
    
    /* FAQ Items */
    .faq-items-container {
        display: grid;
        gap: 15px;
    }
    
    .faq-item {
        background: var(--emerald-50);
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid transparent;
        transition: all 0.3s ease;
    }
    
    .faq-item:hover {
        border-color: var(--emerald-200);
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }
    
    .faq-question {
        font-weight: 600;
        font-size: 1.15rem;
        color: var(--emerald-950);
        margin: 0;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 30px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .faq-question:hover {
        background: var(--emerald-100);
    }
    
    .faq-number {
        color: var(--emerald-500);
        font-weight: 700;
        background: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .faq-question-text {
        flex: 1;
        margin-right: 20px;
    }
    
    .faq-toggle {
        color: var(--emerald-500);
        font-size: 1.5rem;
        font-weight: 400;
        background: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.2);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .faq-question:hover .faq-toggle {
        transform: scale(1.1);
        box-shadow: 0 3px 15px rgba(16, 185, 129, 0.3);
    }
    
    .faq-answer {
        color: var(--emerald-700);
        line-height: 1.7;
        display: none;
        padding: 0 30px;
        background: white;
        border-top: 1px solid var(--emerald-50);
        font-size: 1.05rem;
    }
    
    .faq-answer.active {
        display: block;
        padding: 30px;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Contact Section */
    .contact-support {
        text-align: center;
        background: linear-gradient(135deg, var(--emerald-50) 0%, var(--emerald-100) 100%);
        padding: 80px 40px;
        border-radius: 20px;
        margin: 80px 0;
        border: 2px solid var(--emerald-200);
        box-shadow: 0 8px 40px rgba(16, 185, 129, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .contact-support::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%2310b981" opacity="0.03"><circle cx="50" cy="50" r="40"/></svg>');
        background-size: cover;
    }
    
    .contact-support h3 {
        color: var(--emerald-950);
        margin-bottom: 20px;
        font-size: 2.5rem;
        font-weight: 800;
        position: relative;
    }
    
    .contact-support p {
        color: var(--emerald-700);
        font-size: 1.2rem;
        margin-bottom: 40px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.7;
        position: relative;
    }
    
    .contact-btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, var(--emerald-500) 0%, var(--emerald-600) 100%);
        color: white;
        padding: 18px 45px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
        border: none;
        cursor: pointer;
        position: relative;
    }
    
    .contact-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, var(--emerald-600) 0%, var(--emerald-700) 100%);
    }
    
    /* Info Bar */
    .info-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin: 60px 0;
    }
    
    .info-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        border: 1px solid var(--emerald-100);
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        border-color: var(--emerald-300);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.1);
    }
    
    .info-icon {
        font-size: 2.5rem;
        color: var(--emerald-500);
        margin-bottom: 15px;
        display: block;
    }
    
    .info-title {
        color: var(--emerald-950);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 10px;
    }
    
    .info-text {
        color: var(--emerald-700);
        line-height: 1.6;
    }
    
    /* Scroll to top button */
    .scroll-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        background: var(--emerald-500);
        color: white;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
        z-index: 100;
        border: none;
    }
    
    .scroll-top.visible {
        opacity: 1;
        visibility: visible;
    }
    
    .scroll-top:hover {
        background: var(--emerald-600);
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(16, 185, 129, 0.4);
    }
    
    /* Responsive Design */
    @media (max-width: 1024px) {
        .faq-hero h1 {
            font-size: 2.5rem;
        }
        
        .faq-category {
            padding: 30px;
        }
        
        .category-header {
            flex-direction: column;
            text-align: center;
        }
        
        .category-icon-main {
            margin-right: 0;
            margin-bottom: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .faq-container {
            padding: 15px;
        }
        
        .faq-hero {
            padding: 40px 15px;
            margin: 20px 0 40px;
        }
        
        .faq-hero h1 {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .faq-categories-nav {
            padding: 20px;
            gap: 10px;
        }
        
        .category-nav-btn {
            padding: 12px 20px;
            font-size: 0.95rem;
        }
        
        .faq-question {
            padding: 20px;
            font-size: 1.1rem;
        }
        
        .faq-answer.active {
            padding: 25px 20px;
        }
        
        .contact-support {
            padding: 50px 20px;
            margin: 50px 0;
        }
        
        .contact-support h3 {
            font-size: 2rem;
        }
        
        .contact-btn {
            padding: 16px 35px;
            font-size: 1.1rem;
        }
        
        .scroll-top {
            bottom: 25px;
            right: 25px;
            width: 50px;
            height: 50px;
        }
    }
    
    @media (max-width: 480px) {
        .faq-hero h1 {
            font-size: 1.8rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .category-title {
            font-size: 1.6rem;
        }
        
        .category-icon-main {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        
        .faq-question {
            padding: 18px;
            font-size: 1rem;
        }
        
        .faq-number {
            margin-right: 10px;
            padding: 3px 10px;
        }
        
        .faq-toggle {
            width: 32px;
            height: 32px;
        }
        
        .quick-links {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="faq-container">
    <!-- Hero Section -->
    <div class="faq-hero">
        <h1>Frequently Asked Questions</h1>
        <p class="hero-subtitle">
            Find answers to common questions about Ved Herbs & Ayurveda products, ordering, shipping, and more.
        </p>
        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Questions Answered</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">7</span>
                <span class="stat-label">Categories</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Support Available</span>
            </div>
        </div>
    </div>
    
    <!-- Search Section -->
    <div class="faq-search-container">
        <div class="faq-search">
            <input type="text" id="faqSearch" placeholder="Search for specific questions or topics...">
            <span class="search-icon">🔍</span>
        </div>
        <p class="search-hint">Try searching for "shipping", "payment", "safety", or specific product names</p>
    </div>
    
    <!-- Quick Links -->
    <div class="quick-links">
        <a href="#about" class="quick-link-card">
            <span class="quick-link-icon">🌿</span>
            <div class="quick-link-title">About Us</div>
            <span class="quick-link-count">5 Questions</span>
        </a>
        <a href="#quality" class="quick-link-card">
            <span class="quick-link-icon">🧪</span>
            <div class="quick-link-title">Product Quality</div>
            <span class="quick-link-count">5 Questions</span>
        </a>
        <a href="#order" class="quick-link-card">
            <span class="quick-link-icon">🛒</span>
            <div class="quick-link-title">Order & Payment</div>
            <span class="quick-link-count">5 Questions</span>
        </a>
        <a href="#shipping" class="quick-link-card">
            <span class="quick-link-icon">🚚</span>
            <div class="quick-link-title">Shipping</div>
            <span class="quick-link-count">5 Questions</span>
        </a>
    </div>
    
    <!-- Category Navigation -->
    <div class="faq-categories-nav" id="categoryNav">
        <button class="category-nav-btn active" data-category="all">
            <span class="category-icon-nav">📋</span> All Questions
        </button>
        <button class="category-nav-btn" data-category="about">
            <span class="category-icon-nav">🌿</span> About Us
        </button>
        <button class="category-nav-btn" data-category="quality">
            <span class="category-icon-nav">🧪</span> Product Quality
        </button>
        <button class="category-nav-btn" data-category="usage">
            <span class="category-icon-nav">🧘</span> Usage & Dosage
        </button>
        <button class="category-nav-btn" data-category="health">
            <span class="category-icon-nav">👨‍⚕️</span> Health & Safety
        </button>
        <button class="category-nav-btn" data-category="order">
            <span class="category-icon-nav">🛒</span> Ordering & Payment
        </button>
        <button class="category-nav-btn" data-category="shipping">
            <span class="category-icon-nav">🚚</span> Shipping & Delivery
        </button>
        <button class="category-nav-btn" data-category="returns">
            <span class="category-icon-nav">🔁</span> Returns & Refunds
        </button>
    </div>
    
    <!-- FAQ Categories -->
    
    <!-- About Ved Herbs & Ayurveda -->
    <div class="faq-category" id="about" data-category="about">
        <div class="category-header">
            <div class="category-icon-main">🌿</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">About Ved Herbs & Ayurveda</h2>
                <p class="category-description">Learn about our brand, products, and Ayurvedic philosophy</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-number">1</span>
                    <span class="faq-question-text">What is Ved Herbs & Ayurveda?</span>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">Ved Herbs & Ayurveda is an Ayurvedic wellness brand offering natural herbal products based on traditional Ayurvedic formulations.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-number">2</span>
                    <span class="faq-question-text">Are Ved Herbs & Ayurveda products Ayurvedic?</span>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">Yes, all products are formulated using authentic Ayurvedic herbs and principles.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-number">3</span>
                    <span class="faq-question-text">Are your products natural?</span>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">Yes, our products are made using natural herbal ingredients without harmful chemicals.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-number">4</span>
                    <span class="faq-question-text">Where are Ved Herbs & Ayurveda products made?</span>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">Our products are manufactured in India following Ayurvedic standards.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-number">5</span>
                    <span class="faq-question-text">Is Ved Herbs & Ayurveda an Indian brand?</span>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">Yes, Ved Herbs & Ayurveda is a proudly Indian Ayurvedic brand.</div>
            </div>
        </div>
    </div>
    
    <!-- Product Quality & Safety -->
    <div class="faq-category" id="quality" data-category="quality">
        <div class="category-header">
            <div class="category-icon-main">🧪</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Product Quality & Safety</h2>
                <p class="category-description">Information about product testing, safety, and certifications</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 6-10 -->
            @php
                $qualityFaqs = [
                    6 => "Are your products safe to use?",
                    7 => "Are your products tested for quality?",
                    8 => "Do your products contain steroids or harmful chemicals?",
                    9 => "Are the products approved by FSSAI / AYUSH?",
                    10 => "Can everyone use your products?"
                ];
                
                $qualityAnswers = [
                    6 => "Yes, when used as directed. We recommend following dosage instructions carefully.",
                    7 => "Yes, products undergo quality checks to ensure safety and purity.",
                    8 => "No, our products are free from steroids and harmful chemicals.",
                    9 => "Yes, our products are manufactured in compliance with applicable Ayurvedic and food safety guidelines.",
                    10 => "Most adults can use them, but individuals with medical conditions should consult a doctor."
                ];
            @endphp
            
            @for($i = 6; $i <= 10; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $qualityFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $qualityAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Usage & Dosage -->
    <div class="faq-category" id="usage" data-category="usage">
        <div class="category-header">
            <div class="category-icon-main">🧘</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Usage & Dosage</h2>
                <p class="category-description">Guidelines for using our Ayurvedic products effectively</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 11-15 -->
            @php
                $usageFaqs = [
                    11 => "How should I use your products?",
                    12 => "How long does it take to see results?",
                    13 => "Can I take multiple Ved Herbs products together?",
                    14 => "Is it safe for long-term use?",
                    15 => "What should I do if I miss a dose?"
                ];
                
                $usageAnswers = [
                    11 => "Usage instructions are mentioned on each product label.",
                    12 => "Results vary by individual, body type, and consistent usage. Generally, 2–4 weeks.",
                    13 => "Yes, but we recommend consulting an Ayurvedic expert for best results.",
                    14 => "Ayurvedic products are generally safe for long-term use when taken as directed.",
                    15 => "Continue with your next scheduled dose. Do not double the dose."
                ];
            @endphp
            
            @for($i = 11; $i <= 15; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $usageFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $usageAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Health & Precautions -->
    <div class="faq-category" id="health" data-category="health">
        <div class="category-header">
            <div class="category-icon-main">👨‍⚕️</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Health & Precautions</h2>
                <p class="category-description">Important health considerations and safety information</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 16-20 -->
            @php
                $healthFaqs = [
                    16 => "Can diabetic patients use your products?",
                    17 => "Can women use your products?",
                    18 => "Are your products safe during pregnancy?",
                    19 => "Can elderly people use your products?",
                    20 => "Are there any side effects?"
                ];
                
                $healthAnswers = [
                    16 => "Some products may be suitable. Please consult your doctor before use.",
                    17 => "Yes, products meant for women can be safely used as directed.",
                    18 => "No. Pregnant or breastfeeding women should consult a doctor before use.",
                    19 => "Yes, but medical consultation is advised.",
                    20 => "Our products are natural, but individual reactions may vary."
                ];
            @endphp
            
            @for($i = 16; $i <= 20; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $healthFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $healthAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Ordering & Payment -->
    <div class="faq-category" id="order" data-category="order">
        <div class="category-header">
            <div class="category-icon-main">🛒</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Ordering & Payment</h2>
                <p class="category-description">How to place orders and available payment methods</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 21-25 -->
            @php
                $orderFaqs = [
                    21 => "How can I place an order?",
                    22 => "Do I need to create an account to order?",
                    23 => "What payment methods are accepted?",
                    24 => "Is Cash on Delivery available?",
                    25 => "Is online payment safe?"
                ];
                
                $orderAnswers = [
                    21 => "You can order directly from www.vedherbsandayurveda.com.",
                    22 => "No, you can place an order as a guest.",
                    23 => "We accept UPI, debit/credit cards, net banking, and COD (if available).",
                    24 => "Yes, COD is available on selected locations.",
                    25 => "Yes, all payments are secured with trusted payment gateways."
                ];
            @endphp
            
            @for($i = 21; $i <= 25; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $orderFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $orderAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Shipping & Delivery -->
    <div class="faq-category" id="shipping" data-category="shipping">
        <div class="category-header">
            <div class="category-icon-main">🚚</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Shipping & Delivery</h2>
                <p class="category-description">Delivery timelines, tracking, and shipping policies</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 26-30 -->
            @php
                $shippingFaqs = [
                    26 => "How long does delivery take?",
                    27 => "Do you ship all over India?",
                    28 => "Is free shipping available?",
                    29 => "Can I track my order?",
                    30 => "What if my order is delayed?"
                ];
                
                $shippingAnswers = [
                    26 => "Delivery usually takes 3–7 business days depending on location.",
                    27 => "Yes, we deliver across India.",
                    28 => "Free shipping may be available on selected orders or offers.",
                    29 => "Yes, tracking details are shared after order dispatch.",
                    30 => "You can contact our support team for assistance."
                ];
            @endphp
            
            @for($i = 26; $i <= 30; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $shippingFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $shippingAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Returns & Refunds -->
    <div class="faq-category" id="returns" data-category="returns">
        <div class="category-header">
            <div class="category-icon-main">🔁</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Returns & Refunds</h2>
                <p class="category-description">Our policies for returns, replacements, and refunds</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 31-35 -->
            @php
                $returnsFaqs = [
                    31 => "What is your return policy?",
                    32 => "Can I cancel my order?",
                    33 => "How will I get my refund?",
                    34 => "How long does refund processing take?",
                    35 => "Do you replace damaged products?"
                ];
                
                $returnsAnswers = [
                    31 => "Returns are accepted only for damaged or wrong products.",
                    32 => "Yes, before the order is shipped.",
                    33 => "Refunds are processed to the original payment method.",
                    34 => "Refunds usually take 5–7 working days.",
                    35 => "Yes, replacements are provided after verification."
                ];
            @endphp
            
            @for($i = 31; $i <= 35; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $returnsFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $returnsAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Support & Assistance -->
    <div class="faq-category" data-category="support">
        <div class="category-header">
            <div class="category-icon-main">📞</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Support & Assistance</h2>
                <p class="category-description">How to get help and contact our customer support</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 36-40 -->
            @php
                $supportFaqs = [
                    36 => "How can I contact customer support?",
                    37 => "Do you provide Ayurvedic consultation?",
                    38 => "What are your customer support hours?",
                    39 => "Can I get help choosing the right product?",
                    40 => "How do I report an issue with my order?"
                ];
                
                $supportAnswers = [
                    36 => "You can contact us via phone, WhatsApp, or email mentioned on our website.",
                    37 => "Basic product guidance is available through customer support.",
                    38 => "Monday to Saturday, during business hours.",
                    39 => "Yes, our team can help you choose suitable products.",
                    40 => "You can contact our support team with order details."
                ];
            @endphp
            
            @for($i = 36; $i <= 40; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $supportFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $supportAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- General Ayurvedic FAQs -->
    <div class="faq-category" data-category="ayurveda">
        <div class="category-header">
            <div class="category-icon-main">📚</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">General Ayurvedic FAQs</h2>
                <p class="category-description">Understanding Ayurveda and its principles</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 41-45 -->
            @php
                $ayurvedaFaqs = [
                    41 => "What is Ayurveda?",
                    42 => "Are Ayurvedic products slow in action?",
                    43 => "Can I use Ayurvedic products with allopathy medicines?",
                    44 => "Do Ayurvedic products cure diseases?",
                    45 => "Are your products addictive?"
                ];
                
                $ayurvedaAnswers = [
                    41 => "Ayurveda is an ancient Indian system of natural healing.",
                    42 => "Ayurveda works naturally and gradually for long-term benefits.",
                    43 => "Consult your doctor before combining treatments.",
                    44 => "They support wellness and balance; results vary per individual.",
                    45 => "No, our products are non-addictive."
                ];
            @endphp
            
            @for($i = 41; $i <= 45; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $ayurvedaFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $ayurvedaAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Website & Trust -->
    <div class="faq-category" data-category="trust">
        <div class="category-header">
            <div class="category-icon-main">🌐</div>
            <div class="category-title-wrapper">
                <h2 class="category-title">Website & Trust</h2>
                <p class="category-description">Security, privacy, and trust-related information</p>
            </div>
        </div>
        
        <div class="faq-items-container">
            <!-- FAQ Items 46-50 -->
            @php
                $trustFaqs = [
                    46 => "Is VedHerbsAndAyurveda.com a trusted website?",
                    47 => "Will my personal information be safe?",
                    48 => "Do you offer discounts or offers?",
                    49 => "Can I buy products in bulk?",
                    50 => "Why should I choose Ved Herbs & Ayurveda?"
                ];
                
                $trustAnswers = [
                    46 => "Yes, we ensure secure transactions and authentic products.",
                    47 => "Yes, we follow strict privacy and data protection policies.",
                    48 => "Yes, offers are available during special promotions.",
                    49 => "Yes, bulk inquiries are welcome.",
                    50 => "Because we combine authentic Ayurveda, quality herbs, and customer trust."
                ];
            @endphp
            
            @for($i = 46; $i <= 50; $i++)
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-number">{{ $i }}</span>
                        <span class="faq-question-text">{{ $trustFaqs[$i] }}</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">{{ $trustAnswers[$i] }}</div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Information Bar -->
    <div class="info-bar">
        <div class="info-card">
            <span class="info-icon">🏪</span>
            <h3 class="info-title">Authentic Ayurveda</h3>
            <p class="info-text">All products follow traditional Ayurvedic formulations with 100% natural ingredients</p>
        </div>
        <div class="info-card">
            <span class="info-icon">✅</span>
            <h3 class="info-title">Quality Certified</h3>
            <p class="info-text">Manufactured following Ayurvedic standards and quality guidelines</p>
        </div>
        <div class="info-card">
            <span class="info-icon">🛡️</span>
            <h3 class="info-title">Safe & Secure</h3>
            <p class="info-text">Secure payments and safe delivery across India</p>
        </div>
        <div class="info-card">
            <span class="info-icon">👨‍⚕️</span>
            <h3 class="info-title">Expert Support</h3>
            <p class="info-text">Guidance available from our Ayurvedic wellness team</p>
        </div>
    </div>
    
    <!-- Contact Support Section -->
    <div class="contact-support">
        <h3>Still Have Questions?</h3>
        <p>If you couldn't find the answer you were looking for, our dedicated customer support team is ready to help you with personalized assistance.</p>
        <a href="{{ route('customer.page.contact') }}" class="contact-btn">
            <iconify-icon icon="lucide:message-circle"></iconify-icon> Contact Our Support Team
        </a>
    </div>
</div>

<!-- Scroll to Top Button -->
<button class="scroll-top" id="scrollTop">
    <iconify-icon icon="lucide:arrow-up" width="24" height="24"></iconify-icon>
</button>
@endsection

@push('scripts')
<script>
    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // FAQ Toggle Functionality
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const toggle = this.querySelector('.faq-toggle');
                
                // Toggle active class with animation
                answer.classList.toggle('active');
                
                // Change toggle symbol
                if (answer.classList.contains('active')) {
                    toggle.textContent = '−';
                } else {
                    toggle.textContent = '+';
                }
                
                // Close other answers in the same category
                const parentCategory = this.closest('.faq-category');
                const allAnswersInCategory = parentCategory.querySelectorAll('.faq-answer');
                const allTogglesInCategory = parentCategory.querySelectorAll('.faq-toggle');
                
                allAnswersInCategory.forEach(otherAnswer => {
                    if (otherAnswer !== answer && otherAnswer.classList.contains('active')) {
                        otherAnswer.classList.remove('active');
                    }
                });
                
                allTogglesInCategory.forEach(otherToggle => {
                    if (otherToggle !== toggle && otherToggle.textContent === '−') {
                        otherToggle.textContent = '+';
                    }
                });
            });
        });
        
        // FAQ Search Functionality
        const searchInput = document.getElementById('faqSearch');
        const faqItems = document.querySelectorAll('.faq-item');
        const faqCategories = document.querySelectorAll('.faq-category');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm === '') {
                // Reset view
                faqItems.forEach(item => item.style.display = 'block');
                faqCategories.forEach(cat => cat.style.display = 'block');
                return;
            }
            
            let hasResults = false;
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question-text').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    hasResults = true;
                    // Highlight search term
                    highlightText(item, searchTerm);
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide categories based on visible items
            faqCategories.forEach(category => {
                const visibleItems = category.querySelectorAll('.faq-item[style="display: block"]');
                if (visibleItems.length > 0) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });
            
            // Show no results message
            showNoResults(hasResults);
        });
        
        function highlightText(element, term) {
            const questionText = element.querySelector('.faq-question-text');
            const answerText = element.querySelector('.faq-answer');
            
            [questionText, answerText].forEach(textElement => {
                if (textElement) {
                    const text = textElement.textContent;
                    const regex = new RegExp(`(${term})`, 'gi');
                    const highlighted = text.replace(regex, '<mark class="bg-yellow-200">$1</mark>');
                    textElement.innerHTML = highlighted;
                }
            });
        }
        
        function showNoResults(hasResults) {
            let noResultsMsg = document.getElementById('no-results-message');
            
            if (!hasResults) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.id = 'no-results-message';
                    noResultsMsg.innerHTML = `
                        <div style="text-align: center; padding: 40px; background: var(--emerald-50); border-radius: 15px; margin: 30px 0;">
                            <h3 style="color: var(--emerald-950); margin-bottom: 10px;">No results found</h3>
                            <p style="color: var(--emerald-700);">Try different keywords or <a href="{{ route('customer.page.contact') }}" style="color: var(--emerald-600); text-decoration: underline;">contact our support team</a></p>
                        </div>
                    `;
                    document.querySelector('.faq-container').appendChild(noResultsMsg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }
        
        // Category Navigation
        const categoryButtons = document.querySelectorAll('.category-nav-btn');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.getAttribute('data-category');
                
                // Show/hide categories
                faqCategories.forEach(cat => {
                    if (category === 'all' || cat.getAttribute('data-category') === category) {
                        cat.style.display = 'block';
                        // Show all items in the category
                        cat.querySelectorAll('.faq-item').forEach(item => {
                            item.style.display = 'block';
                        });
                    } else {
                        cat.style.display = 'none';
                    }
                });
                
                // Reset search
                searchInput.value = '';
                
                // Remove highlights
                removeHighlights();
                
                // Scroll to categories
                document.querySelector('.faq-categories-nav').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });
        
        function removeHighlights() {
            document.querySelectorAll('mark').forEach(mark => {
                const parent = mark.parentNode;
                parent.replaceChild(document.createTextNode(mark.textContent), mark);
                parent.normalize();
            });
        }
        
        // Quick link cards functionality
        document.querySelectorAll('.quick-link-card').forEach(card => {
            card.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetCategory = document.getElementById(targetId);
                
                if (targetCategory) {
                    // Set active category
                    document.querySelectorAll('.category-nav-btn').forEach(btn => btn.classList.remove('active'));
                    const category = targetCategory.getAttribute('data-category');
                    document.querySelector(`.category-nav-btn[data-category="${category}"]`).classList.add('active');
                    
                    // Show only this category
                    faqCategories.forEach(cat => {
                        if (cat.getAttribute('data-category') === category) {
                            cat.style.display = 'block';
                        } else {
                            cat.style.display = 'none';
                        }
                    });
                    
                    // Scroll to category
                    targetCategory.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Open first FAQ in category
                    const firstFaq = targetCategory.querySelector('.faq-item');
                    if (firstFaq) {
                        const firstAnswer = firstFaq.querySelector('.faq-answer');
                        const firstToggle = firstFaq.querySelector('.faq-toggle');
                        
                        if (!firstAnswer.classList.contains('active')) {
                            firstAnswer.classList.add('active');
                            firstToggle.textContent = '−';
                        }
                    }
                }
            });
        });
        
        // Scroll to Top Functionality
        const scrollTopBtn = document.getElementById('scrollTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        });
        
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Auto-open first FAQ in each category on hover
        faqCategories.forEach(category => {
            category.addEventListener('mouseenter', function() {
                const firstFaq = this.querySelector('.faq-item');
                if (firstFaq) {
                    const firstToggle = firstFaq.querySelector('.faq-toggle');
                    const firstAnswer = firstFaq.querySelector('.faq-answer');
                    
                    // Only auto-open if not already opened
                    if (!firstAnswer.classList.contains('active')) {
                        setTimeout(() => {
                            firstAnswer.classList.add('active');
                            firstToggle.textContent = '−';
                        }, 300);
                    }
                }
            });
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + F to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                searchInput.focus();
                searchInput.select();
            }
            
            // Escape to clear search
            if (e.key === 'Escape' && document.activeElement === searchInput) {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
            }
        });
    });
    
    // Scroll to specific question
    function scrollToQuestion(questionNumber) {
        const questionElement = document.querySelector(`.faq-number[textContent*="${questionNumber}"]`)?.closest('.faq-question');
        if (questionElement) {
            const category = questionElement.closest('.faq-category');
            
            // Show category
            document.querySelectorAll('.faq-category').forEach(cat => cat.style.display = 'none');
            category.style.display = 'block';
            
            // Set active category button
            document.querySelectorAll('.category-nav-btn').forEach(btn => btn.classList.remove('active'));
            const categoryType = category.getAttribute('data-category');
            document.querySelector(`.category-nav-btn[data-category="${categoryType}"]`).classList.add('active');
            
            // Scroll to question
            questionElement.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            
            // Open the question
            const answer = questionElement.nextElementSibling;
            const toggle = questionElement.querySelector('.faq-toggle');
            
            if (!answer.classList.contains('active')) {
                answer.classList.add('active');
                toggle.textContent = '−';
            }
        }
    }
</script>
@endpush