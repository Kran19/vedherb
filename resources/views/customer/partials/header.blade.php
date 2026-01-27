<header class="header-container">
    <div class="header-inner">
        <!-- Mobile Menu Icon -->
        <button id="mobile-menu-toggle" class="mobile-menu-button" aria-label="Open menu">
            <i data-lucide="menu" class="w-7 h-7"></i>
        </button>

        <!-- Logo -->
        <a href="{{ route('customer.home.index') }}" style="display: flex; align-items: center; margin-left: 1rem;">
            <img src="{{ asset('assets/images/logo.png') }}" 
                 alt="VED HERBS & AYURVEDA" 
                 style="height: 64px; width: auto; object-fit: contain;"
                 loading="eager" 
                 width="160" 
                 height="64">
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Main navigation">
            <a href="{{ route('customer.home.index') }}" class="nav-link">Home</a>
            <a href="{{ route('customer.products.shop') }}" class="nav-link">Shop</a>
            <a href="{{ route('customer.page.about') }}" class="nav-link">About us</a>
            <a href="{{ route('customer.products.blog') }}" class="nav-link">Blog</a>
            <a href="{{ route('customer.page.videos') }}" class="nav-link">Videos</a>
            <a href="{{ route('customer.login') }}" class="nav-link">Log-in</a>
        </nav>

        <!-- Add Swiper CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Icons Section -->
        <div class="icons-section">
            <!-- Search Input -->
            <div class="search-container">
                <i data-lucide="search" class="search-icon"></i>
                <input type="text" 
                       placeholder="Search herbs, wellness..." 
                       class="search-input"
                       aria-label="Search products">
            </div>

            <!-- Account Icon -->
            <a href="{{ route('customer.account.profile') }}" class="icon-link" aria-label="My account">
                <i data-lucide="user" class="w-7 h-7"></i>
            </a>

            <!-- Cart Icon -->
            <a href="{{ route('customer.cart') }}" class="cart-icon-container icon-link" aria-label="Shopping cart">
                <i data-lucide="shopping-cart" class="w-7 h-7 relative z-0"></i>
                <span id="header-cart-badge" class="cart-badge hidden"></span>
            </a>
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>

<!-- Mobile Menu Sidebar -->
<div id="mobile-menu-sidebar" class="mobile-menu-sidebar">
    <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; border-bottom: 1px solid #e7e5e4;">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('assets/images/logo.png') }}" 
                 alt="VED HERBS & AYURVEDA" 
                 style="height: 48px; width: auto; object-fit: contain;"
                 loading="eager"
                 width="120"
                 height="48">
        </div>
        <button id="mobile-menu-close" style="padding: 0.5rem; color: #57534e; transition: color 0.2s;" 
                onmouseover="this.style.color='#065f46'" onmouseout="this.style.color='#57534e'" 
                aria-label="Close menu">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
    </div>

    <div style="padding: 1rem;">

        <a href="{{ route('customer.home.index') }}"
            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0; font-size: 1.125rem; font-weight: 500; color: #44403c; transition: all 0.2s; border-radius: 0.5rem; padding-left: 0.75rem;"
            onmouseover="this.style.color='#065f46'; this.style.backgroundColor='#fafaf9'"
            onmouseout="this.style.color='#44403c'; this.style.backgroundColor='transparent'">
            <iconify-icon icon="lucide:home" width="18"></iconify-icon>
            <span>Home</span>
        </a>
        <a href="{{ route('customer.products.shop') }}"
            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0; font-size: 1.125rem; font-weight: 500; color: #44403c; transition: all 0.2s; border-radius: 0.5rem; padding-left: 0.75rem;"
            onmouseover="this.style.color='#065f46'; this.style.backgroundColor='#fafaf9'"
            onmouseout="this.style.color='#44403c'; this.style.backgroundColor='transparent'">
            <iconify-icon icon="lucide:shopping-bag" width="18"></iconify-icon>
            <span>Shop</span>
        </a>

        <a href="{{ route('customer.page.about') }}"
            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0; font-size: 1.125rem; font-weight: 500; color: #44403c; transition: all 0.2s; border-radius: 0.5rem; padding-left: 0.75rem;"
            onmouseover="this.style.color='#065f46'; this.style.backgroundColor='#fafaf9'"
            onmouseout="this.style.color='#44403c'; this.style.backgroundColor='transparent'">
            <iconify-icon icon="lucide:info" width="18"></iconify-icon>
            <span>About us</span>
        </a>

        <a href="{{ route('customer.products.blog') }}"
            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0; font-size: 1.125rem; font-weight: 500; color: #44403c; transition: all 0.2s; border-radius: 0.5rem; padding-left: 0.75rem;"
            onmouseover="this.style.color='#065f46'; this.style.backgroundColor='#fafaf9'"
            onmouseout="this.style.color='#44403c'; this.style.backgroundColor='transparent'">
            <iconify-icon icon="lucide:file-text" width="18"></iconify-icon>
            <span>Blog</span>
        </a>

       <a href="{{ route('customer.page.videos') }}"
            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0; font-size: 1.125rem; font-weight: 500; color: #44403c; transition: all 0.2s; border-radius: 0.5rem; padding-left: 0.75rem;"
            onmouseover="this.style.color='#065f46'; this.style.backgroundColor='#fafaf9'"
            onmouseout="this.style.color='#44403c'; this.style.backgroundColor='transparent'">
            <iconify-icon icon="lucide:video" width="18"></iconify-icon>
            <span>Videos</span>
        </a>

        <a href="{{ route('customer.login') }}"
            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0; font-size: 1.125rem; font-weight: 500; color: #44403c; transition: all 0.2s; border-radius: 0.5rem; padding-left: 0.75rem;"
            onmouseover="this.style.color='#065f46'; this.style.backgroundColor='#fafaf9'"
            onmouseout="this.style.color='#44403c'; this.style.backgroundColor='transparent'">
            <iconify-icon icon="lucide:log-in" width="18"></iconify-icon>
            <span>Log-in</span>
        </a>
    </div>
</div>