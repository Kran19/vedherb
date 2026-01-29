<script>
    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
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
        document.addEventListener('keydown', function (event) {
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
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function () {
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
    async function updateCartBadge(count = null) {
        try {
            let totalItems;
            if (count !== null) {
                totalItems = count;
            } else {
                const response = await axios.get('{{ route('customer.cart.count') }}');
                totalItems = response.data.count;
            }

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

    // Expose updateCartBadge globally
    window.updateCartBadge = updateCartBadge;

    // Custom event for cart updates within same page
    window.addEventListener('cartUpdated', () => updateCartBadge());

    // Update badge after page is fully loaded
    window.addEventListener('load', function () {
        setTimeout(updateCartBadge, 100);
    });

    // Intro overlay functionality
    function initializeIntroOverlay() {
        const introOverlay = document.getElementById('intro-overlay');
        const loaderFill = document.getElementById('intro-loader-fill');

        if (!introOverlay || !loaderFill) return;

        // Start the loader animation after a short delay
        setTimeout(() => {
            if (loaderFill) loaderFill.style.width = '100%';

            setTimeout(() => {
                if (introOverlay) introOverlay.classList.add('hidden');
            }, 1000);
        }, 500);
    }

    // Cart functionality
    function initializeCart() {
        // ... (existing code inside initializeCart)
    }

    // Expose functions globally for onclick handlers
    async function addToCart(variantId, quantity = 1, button = null) {
        if (!variantId) {
            Swal.fire('Oops!', 'Please select a variant first', 'warning');
            return;
        }

        try {
            if (button) {
                button.disabled = true;
                button.classList.add('opacity-50');
            }

            const response = await axios.post('{{ route('customer.cart.add') }}', {
                variant_id: variantId,
                quantity: quantity
            });

            if (response.data.success) {
                updateCartBadge();
                Swal.fire({
                    title: 'Added!',
                    text: response.data.message || 'Product added to cart',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                // Trigger success animation if button exists
                if (button) {
                    const originalHTML = button.innerHTML;
                    button.innerHTML = '<iconify-icon icon="lucide:check" width="16"></iconify-icon> Added';
                    setTimeout(() => {
                        button.innerHTML = originalHTML;
                        button.disabled = false;
                        button.classList.remove('opacity-50');
                    }, 2000);
                }
            } else {
                Swal.fire('Error', response.data.message || 'Failed to add item', 'error');
                if (button) {
                    button.disabled = false;
                    button.classList.remove('opacity-50');
                }
            }
        } catch (error) {
            console.error('Add to cart error:', error);
            Swal.fire('Error', error.response?.data?.message || 'Error connecting to server', 'error');
            if (button) {
                button.disabled = false;
                button.classList.remove('opacity-50');
            }
        }
    }

    async function removeFromWishlist(itemId) {
        const result = await Swal.fire({
            title: 'Remove from wishlist?',
            text: "Are you sure you want to remove this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Yes, remove it!'
        });

        if (result.isConfirmed) {
            try {
                const response = await axios.post('{{ route('customer.wishlist.remove') }}', {
                    item_id: itemId
                });

                if (response.data.success) {
                    Swal.fire('Removed!', response.data.message, 'success')
                        .then(() => {
                            location.reload();
                        });
                } else {
                    Swal.fire('Error', response.data.message || 'Failed to remove item', 'error');
                }
            } catch (error) {
                console.error('Remove wishlist error:', error);
                Swal.fire('Error', error.response?.data?.message || 'Error connecting to server', 'error');
            }
        }
    }
</script>