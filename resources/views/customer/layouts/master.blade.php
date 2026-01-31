<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ved Herbs & Ayurveda')</title>

    <!-- Preconnect to CDNs -->
    <!-- Preconnect to CDNs -->
    <link rel="preconnect" href="https://code.iconify.design">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Dynamic Favicon -->
    @php
        $favicon = \App\Helpers\SettingsHelper::get('favicon_url', asset('assets/images/favicon.ico'));
    @endphp
    <link rel="icon" href="{{ $favicon }}">


    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Critical CSS -->
    <style>
        /* Critical styles for initial rendering */
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #fafaf9;
            color: #292524;
            visibility: hidden;
        }

        body.loaded {
            visibility: visible;
        }

        /* Header critical styles */
        .header-container {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(231, 229, 228, 0.6);
            height: 80px;
            display: flex;
            align-items: center;
        }

        .header-inner {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icons-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: #57534e;
        }

        .icon-link {
            padding: 0.25rem;
            transition: color 0.2s;
        }

        .icon-link:hover {
            color: #065f46;
        }

        .cart-icon-container {
            position: relative;
            display: inline-block;
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
            z-index: 10;
        }

        .cart-badge-ping {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            z-index: 1;
        }

        .desktop-nav {
            display: none;
        }

        @media (min-width: 768px) {
            .desktop-nav {
                display: flex;
                align-items: center;
                gap: 2rem;
                font-size: 1.125rem;
                font-weight: 500;
                color: #57534e;
            }

            .nav-link {
                transition: all 0.2s;
            }

            .nav-link:hover {
                color: #065f46;
                font-size: 1.25rem;
            }
        }

        .mobile-menu-sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            width: 85%;
            max-width: 320px;
            height: 100vh;
            background: white;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease-in-out;
            z-index: 100;
            overflow-y: auto;
        }

        .mobile-menu-sidebar.open {
            left: 0;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-menu-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        body.menu-open {
            overflow: hidden;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f5f5f4;
        }

        ::-webkit-scrollbar-thumb {
            background: #d6d3d1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a29e;
        }

        [data-lucide] {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .lucide-loaded [data-lucide] {
            opacity: 1;
        }

        .offer-bar {
            background-color: #065f46;
            color: #d1fae5;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.625rem 0;
            text-align: center;
            letter-spacing: 0.05em;
        }

        .search-container {
            display: none;
            align-items: center;
            position: relative;
        }

        @media (min-width: 768px) {
            .search-container {
                display: flex;
            }
        }

        .search-input {
            width: 224px;
            padding-left: 2.25rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            font-size: 0.875rem;
            border-radius: 9999px;
            border: 1px solid #e7e5e4;
            background-color: #fafaf9;
            outline: none;
            transition: all 0.2s;
        }

        .search-input:focus {
            background-color: white;
            border-color: #059669;
            box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.2);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            width: 1rem;
            height: 1rem;
            color: #a8a29e;
        }

        .mobile-menu-button {
            display: block;
            padding: 0.5rem;
            color: #57534e;
        }

        @media (min-width: 768px) {
            .mobile-menu-button {
                display: none;
            }
        }

        /* Custom styles from index.php */
        /* Intro Overlay Styles */
        .intro-overlay {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1.75rem;
            padding: 1.5rem;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .intro-overlay.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .intro-logo {
            width: 100%;
            max-width: 250px;
            height: auto;
            opacity: 0;
            transform: translateY(20px) scale(0.95);
            animation: introFadeUp 1s ease-out 0.3s forwards;
        }

        .intro-loader {
            width: 120px;
            height: 4px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            opacity: 0;
            animation: introFade 0.5s ease-out 0.9s forwards;
        }

        .intro-loader-fill {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #10b981, #059669);
            border-radius: 999px;
            transition: width 1.5s ease-in-out;
        }

        @keyframes introFadeUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes introFade {
            to {
                opacity: 1;
            }
        }

        /* Cart Toast Notification */
        .cart-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #047857;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .cart-toast.show {
            transform: translateX(-50%) translateY(0);
        }

        .cart-toast .check-icon {
            width: 20px;
            height: 20px;
            background: white;
            color: #047857;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 640px) {
            .testimonial-container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .testimonial {
                min-width: 85vw !important;
                padding: 1.5rem;
            }

            .cart-toast {
                bottom: 120px;
                width: 90%;
                max-width: 300px;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .testimonial {
                min-width: 350px !important;
            }
        }

        @keyframes checkmarkBounce {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .added-animation {
            animation: checkmarkBounce 0.3s ease-out;
        }

        .pulse-animation {
            animation: pulse 0.5s ease-in-out;
        }

        @media (max-width: 640px) {
            .intro-logo {
                max-width: 250px;
            }

            .intro-loader {
                width: 100px;
            }
        }

        @media (min-width: 641px) and (max-width: 1023px) {
            .intro-logo {
                max-width: 220px;
            }
        }

        @media (min-width: 1024px) {
            .intro-logo {
                max-width: 280px;
            }
        }

        @media (min-width: 1440px) {
            .intro-logo {
                max-width: 320px;
            }
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>

    <!-- Load Google Fonts -->
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap">
    </noscript>

    <!-- Single Lucide import -->
    <script src="https://unpkg.com/lucide@latest" defer></script>

    <!-- Iconify CDN -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js" defer></script>

    <!-- Axios for API calls -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body>

    <!-- Top Offer Bar -->
    <div class="offer-bar">
        Up to 60% OFF • Free Shipping over ₹999
    </div>

    <!-- Header / Navigation -->
    @include('customer.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('customer.partials.footer')


    <!-- Cart Toast Notification -->
    <!-- <div id="cart-toast" class="cart-toast">
        <div class="check-icon">
            <i data-lucide="check" class="w-3 h-3"></i>
        </div>
        <span id="toast-message">Product added to cart!</span>
    </div> -->

    <!-- Scripts -->
    @include('customer.partials.scripts')

    <script>
        // Prevent FOUC
        document.addEventListener('DOMContentLoaded', function () {
            document.body.classList.add('loaded');
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')

    {{-- Page-specific scripts --}}
    @yield('scripts')
</body>

</html>