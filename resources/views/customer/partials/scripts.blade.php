<script>
    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        function initializeLucide() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
                document.body.classList.add('lucide-loaded');
            }
        }
        
        if (typeof lucide !== 'undefined') {
            initializeLucide();
        } else {
            document.addEventListener('lucide:loaded', initializeLucide);
        }

        // Update cart badge on initial load
        updateCartBadge();

        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenuSidebar = document.getElementById('mobile-menu-sidebar');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const body = document.body;

        function openMobileMenu() {
            mobileMenuSidebar.classList.add('open');
            mobileMenuOverlay.classList.add('open');
            body.classList.add('menu-open');
        }

        function closeMobileMenu() {
            mobileMenuSidebar.classList.remove('open');
            mobileMenuOverlay.classList.remove('open');
            body.classList.remove('menu-open');
        }

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', openMobileMenu);
        }
        
        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', closeMobileMenu);
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
        }

        // Close mobile menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && mobileMenuSidebar.classList.contains('open')) {
                closeMobileMenu();
            }
        });

        // Close menu when clicking on mobile menu links
        const mobileMenuLinks = document.querySelectorAll('#mobile-menu-sidebar a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Close mobile menu on window resize (when switching to desktop)
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                if (window.innerWidth >= 768 && mobileMenuSidebar.classList.contains('open')) {
                    closeMobileMenu();
                }
            }, 100);
        });

        // Update cart badge after a short delay to ensure DOM is ready
        setTimeout(updateCartBadge, 50);
        
        // Initialize intro overlay
        initializeIntroOverlay();
        
        // Initialize cart functionality
        initializeCart();
    });

    // Cart badge update function
    function updateCartBadge() {
        try {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalItems = 0;
            cart.forEach(item => {
                totalItems += item.quantity || 0;
            });

            const badge = document.getElementById('header-cart-badge');
            if (!badge) return;

            if (totalItems > 0) {
                badge.style.display = 'flex';
                badge.innerHTML = `
                    <span class="cart-badge-ping" style="animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite; background-color: #34d399; opacity: 0.75;"></span>
                    <span style="position: relative; z-index: 10; background-color: #10b981; color: white; padding: 0 6px; border-radius: 9999px;">
                        ${totalItems > 99 ? '99+' : totalItems}
                    </span>
                `;
            } else {
                badge.style.display = 'none';
                badge.innerHTML = '';
            }
        } catch (e) {
            console.error('Error updating cart badge:', e);
        }
    }

    // Listen for cart updates
    window.addEventListener('storage', function(e) {
        if (e.key === 'cart') {
            updateCartBadge();
        }
    });

    // Custom event for cart updates within same page
    window.addEventListener('cartUpdated', updateCartBadge);

    // Update badge after page is fully loaded
    window.addEventListener('load', function() {
        setTimeout(updateCartBadge, 100);
    });

    // Intro overlay functionality
    function initializeIntroOverlay() {
        const introOverlay = document.getElementById('intro-overlay');
        const loaderFill = document.getElementById('intro-loader-fill');
        
        if (!introOverlay || !loaderFill) return;
        
        // Show intro overlay on page load
        function showIntroOverlay() {
            // Make sure overlay is visible (remove hidden class)
            introOverlay.classList.remove('hidden');
            
            // Start the loader animation after a short delay
            setTimeout(() => {
                // Animate loader to 100%
                loaderFill.style.width = '100%';
                
                // Hide overlay after loader completes
                setTimeout(() => {
                    // Add hidden class to fade out
                    introOverlay.classList.add('hidden');
                }, 1500); // Wait for loader to complete
            }, 1000); // Initial delay before loader starts
        }
        
        // Show intro overlay
        showIntroOverlay();
    }

    // Cart functionality
    function initializeCart() {
        // Initialize cart in localStorage if not exists
        if (!localStorage.getItem('cart')) {
            localStorage.setItem('cart', JSON.stringify([]));
        }

        // Toast notification elements
        const cartToast = document.getElementById('cart-toast');
        const toastMessage = document.getElementById('toast-message');
        
        // Function to show toast notification
        function showToast(message) {
            if (!cartToast || !toastMessage) return;
            
            toastMessage.textContent = message;
            cartToast.classList.add('show');
            
            // Auto hide after 2 seconds
            setTimeout(() => {
                cartToast.classList.remove('show');
            }, 2000);
        }
        
        // Function to add product to cart
        function addToCart(productData) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // Check if product already exists in cart
            const existingIndex = cart.findIndex(item => item.id === productData.id);
            
            if (existingIndex > -1) {
                // Increment quantity if product exists
                cart[existingIndex].quantity += 1;
            } else {
                // Add new product to cart
                cart.push({
                    ...productData,
                    quantity: 1
                });
            }
            
            // Save to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Update header cart count
            updateCartBadge();
            
            // Show success message
            showToast(`${productData.name} added to cart!`);
            
            // Trigger haptic feedback on mobile
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }
        }
        
        // Function to handle mobile add button (plus icon)
        function handleMobileAdd(button) {
            // Get product data
            const productData = {
                id: button.getAttribute('data-id'),
                name: button.getAttribute('data-name'),
                price: parseFloat(button.getAttribute('data-price')),
                image: button.getAttribute('data-image'),
                weight: button.getAttribute('data-weight')
            };
            
            // Add to cart
            addToCart(productData);
            
            // Change icon to checkmark
            const icon = button.querySelector('i');
            if (icon) {
                // Change icon
                button.innerHTML = '<i data-lucide="check" class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600"></i>';
                
                // Update lucide icons
                if (window.lucide) {
                    lucide.createIcons();
                }
                
                // Add animation class
                button.classList.add('added-animation');
                button.classList.remove('bg-white/95');
                button.classList.add('bg-emerald-100', 'border-emerald-300');
                
                // Reset after 1.5 seconds
                setTimeout(() => {
                    button.innerHTML = '<i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>';
                    if (window.lucide) {
                        lucide.createIcons();
                    }
                    button.classList.remove('added-animation', 'bg-emerald-100', 'border-emerald-300');
                    button.classList.add('bg-white/95');
                }, 1500);
            }
        }
        
        // Function to handle desktop add button
        function handleDesktopAdd(button) {
            // Get product data
            const productData = {
                id: button.getAttribute('data-id'),
                name: button.getAttribute('data-name'),
                price: parseFloat(button.getAttribute('data-price')),
                image: button.getAttribute('data-image'),
                weight: button.getAttribute('data-weight')
            };
            
            // Add to cart
            addToCart(productData);
            
            // Change button text and style
            const originalHTML = button.innerHTML;
            button.innerHTML = `
                <iconify-icon icon="lucide:check" width="14" height="14"></iconify-icon>
                <span>Added ✓</span>
            `;
            button.classList.add('bg-emerald-100', 'text-emerald-800', 'border-emerald-300');
            button.classList.remove('hover:bg-stone-50');
            
            // Disable button
            button.disabled = true;
            
            // Reset after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.classList.remove('bg-emerald-100', 'text-emerald-800', 'border-emerald-300');
                button.classList.add('hover:bg-stone-50');
                button.disabled = false;
            }, 2000);
        }
        
        // Add event listeners to mobile add buttons
        document.querySelectorAll('.mobile-add-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                handleMobileAdd(this);
            });
        });
        
        // Add event listeners to desktop add buttons
        document.querySelectorAll('.desktop-add-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                handleDesktopAdd(this);
            });
        });
    }
</script>