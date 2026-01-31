@extends('customer.layouts.master')

@section('title', 'About Ayurveda - Ved Herbs & Ayurveda')

@push('styles')
    <style>
        /* About Page Critical CSS */
        .about-breadcrumb {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .about-nav {
            display: flex;
            font-size: 0.875rem;
            color: #78716c;
            margin-bottom: 2rem;
        }

        .about-nav ol {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .about-nav li {
            display: inline-flex;
            align-items: center;
        }

        .about-nav a {
            display: inline-flex;
            align-items: center;
            transition: color 0.2s;
        }

        .about-nav a:hover {
            color: #047857;
        }

        .about-section {
            margin-bottom: 5rem;
        }

        .about-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .about-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #d1fae5;
            color: #047857;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .about-title {
            font-size: 1.875rem;
            font-family: serif;
            font-weight: 600;
            color: #1c1917;
            margin-bottom: 1rem;
        }

        .about-description {
            color: #57534e;
            max-width: 32rem;
            margin: 0 auto;
        }

        .about-grid {
            display: grid;
            gap: 3rem;
            align-items: center;
            margin-bottom: 4rem;
        }

        @media (min-width: 768px) {
            .about-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .about-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1c1917;
            margin-bottom: 1rem;
        }

        .about-content p {
            color: #57534e;
            line-height: 1.75;
            margin-bottom: 1rem;
        }

        .about-image {
            position: relative;
        }

        .about-image-container {
            aspect-ratio: 4/3;
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid #e7e5e4;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .certifications-section {
            background-color: #ecfdf5;
            border-radius: 1.5rem;
            padding: 2rem;
            margin-bottom: 4rem;
        }

        @media (min-width: 768px) {
            .certifications-section {
                padding: 3rem;
            }
        }

        .certifications-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1c1917;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .certifications-grid {
            display: grid;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .certifications-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .certifications-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .certification-card {
            background-color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            border: 1px solid #d1fae5;
            text-align: center;
        }

        .certification-icon {
            color: #047857;
            margin-bottom: 1rem;
        }

        .certification-card h4 {
            font-weight: 600;
            color: #1c1917;
            margin-bottom: 0.5rem;
        }

        .certification-card .description {
            font-size: 0.875rem;
            color: #57534e;
            margin-bottom: 0.5rem;
        }

        .certification-card .number {
            font-size: 0.75rem;
            color: #78716c;
        }

        .certification-card .number span {
            font-weight: 500;
        }

        .products-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1c1917;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .products-grid {
            display: grid;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .product-card {
            background-color: #fafaf9;
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: box-shadow 0.3s;
        }

        .product-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-icon {
            color: #047857;
            margin-bottom: 1rem;
        }

        .product-card h4 {
            font-weight: 600;
            color: #1c1917;
            margin-bottom: 0.5rem;
        }

        .product-card p {
            color: #57534e;
            font-size: 0.875rem;
        }

        .cta-section {
            background: linear-gradient(to right, #064e3b, #047857);
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .cta-section {
                padding: 3rem;
            }
        }

        .cta-content {
            max-width: 32rem;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .cta-title {
                font-size: 1.875rem;
            }
        }

        .cta-description {
            color: #d1fae5;
            margin-bottom: 2rem;
        }

        .cta-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            justify-content: center;
        }

        @media (min-width: 640px) {
            .cta-buttons {
                flex-direction: row;
            }
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 3rem;
            padding: 0 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .cta-button-primary {
            background-color: white;
            color: #064e3b;
        }

        .cta-button-primary:hover {
            background-color: #ecfdf5;
        }

        .cta-button-secondary {
            background-color: #064e3b;
            color: white;
            border: 1px solid #047857;
        }

        .cta-button-secondary:hover {
            background-color: #047857;
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="about-breadcrumb">
        <nav class="about-nav" aria-label="Breadcrumb">
            <ol>
                <li>
                    <a href="{{ route('customer.home.index') }}">
                        <iconify-icon icon="lucide:home" width="16"></iconify-icon>
                        <span style="margin-left: 0.5rem;">Home</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div style="display: flex; align-items: center;">
                        <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                        <span style="margin-left: 0.5rem; color: #1c1917; font-weight: 500;">About Ayurveda</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Our Journey & Quality -->
        <section class="about-section">
            <div class="about-header">
                <span class="about-badge">About Us</span>
                <h2 class="about-title">Our Journey, Values & Quality</h2>
                <p class="about-description">
                    Learn more about our journey, our values, and the premium quality we deliver.
                </p>
            </div>

            <!-- Who We Are -->
            <div class="about-grid">
                <div class="about-content">
                    <h3>Who We Are</h3>
                    <p>
                        We are a trusted wellness brand committed to bringing you the purest Himalayan Shilajit and natural
                        supplements.
                    </p>
                    <p>
                        With a deep focus on quality, authenticity, and holistic health, every product we offer is crafted
                        to meet the
                        highest standards of purity, potency, and safety.
                    </p>
                </div>

                <div class="about-image">
                    <div class="about-image-container">
                        <img src="https://www.himalayaherbstores.com/images/products/medicinal-herbs.jpg?auto=format&fit=crop&w=1200&q=80"
                            alt="Himalayan Herbs">
                    </div>
                </div>
            </div>

            <!-- Certifications -->
            <div class="certifications-section">
                <h3 class="certifications-title">Certifications & Trust</h3>

                <div class="certifications-grid">
                    <!-- MSME -->
                    <div class="certification-card">
                        <iconify-icon icon="lucide:badge-check" width="36" class="certification-icon"></iconify-icon>
                        <h4>MSME Certified</h4>
                        <p class="description">Certified for quality and authenticity.</p>
                        <p class="number">Registration No: <span>UDYAM-GJ-01-0552312</span></p>
                    </div>

                    <!-- FSSAI -->
                    <div class="certification-card">
                        <iconify-icon icon="lucide:shield-check" width="36" class="certification-icon"></iconify-icon>
                        <h4>FSSAI Approved</h4>
                        <p class="description">Ensuring strict food safety standards.</p>
                        <p class="number">License No: <span>30250920121566680</span></p>
                    </div>

                    <!-- GST -->
                    <div class="certification-card">
                        <iconify-icon icon="lucide:file-text" width="36" class="certification-icon"></iconify-icon>
                        <h4>GST Registered</h4>
                        <p class="description">Official business registration & tax compliance.</p>
                        <p class="number">GST No: <span>24FWNPA8069P1ZQ</span></p>
                    </div>

                    <!-- Lab Tested -->
                    <div class="certification-card">
                        <iconify-icon icon="lucide:flask-conical" width="36" class="certification-icon"></iconify-icon>
                        <h4>Lab Tested</h4>
                        <p class="description">Rigorously tested in certified laboratories.</p>
                        <p class="number">Batch Verified: <span>LT-2025-09</span></p>
                    </div>
                </div>
            </div>

            <!-- Our Products -->
            <div>
                <h3 class="products-title">Our Products</h3>

                <div class="products-grid">
                    <!-- Shilajit -->
                    <div class="product-card">
                        <iconify-icon icon="lucide:mountain" width="36" class="product-icon"></iconify-icon>
                        <h4>Pure Himalayan Shilajit</h4>
                        <p>
                            Authentic, mineral-rich, and lab-tested Shilajit for strength, stamina, and vitality.
                        </p>
                    </div>

                    <!-- Supplements -->
                    <div class="product-card">
                        <iconify-icon icon="lucide:leaf" width="36" class="product-icon"></iconify-icon>
                        <h4>Natural Supplements</h4>
                        <p>
                            Herbal formulations designed to support immunity, digestion, and overall wellness.
                        </p>
                    </div>

                    <!-- Combos -->
                    <div class="product-card">
                        <iconify-icon icon="lucide:package" width="36" class="product-icon"></iconify-icon>
                        <h4>Health Combos</h4>
                        <p>
                            Specially curated packs for complete and holistic health benefits.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content">
                <h2 class="cta-title">Begin Your Ayurvedic Journey</h2>
                <p class="cta-description">
                    Discover your unique constitution and personalized wellness plan.
                </p>
                <div class="cta-buttons">
                    <a href="tel:{{ \App\Helpers\SettingsHelper::get('store_phone') }}"
                        class="cta-button cta-button-primary">
                        <iconify-icon icon="lucide:phone" width="18" style="margin-right: 0.5rem;"></iconify-icon>
                        Book Consultation
                    </a>
                    <a href="{{ route('customer.products.list') }}" class="cta-button cta-button-secondary">
                        Explore Products
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // About page specific scripts
        });
    </script>
@endpush