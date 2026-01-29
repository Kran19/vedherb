@extends('customer.layouts.master')

@section('title', 'Shopping Cart - Ved Herbs & Ayurveda')

@push('styles')
<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.3s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .cart-item-transition {
        transition: all 0.3s ease-out;
    }

    .btn-loading {
        position: relative;
        color: transparent !important;
        pointer-events: none;
    }

    .btn-loading::after {
        content: "";
        position: absolute;
        width: 1.25rem;
        height: 1.25rem;
        top: 50%;
        left: 50%;
        margin-top: -0.625rem;
        margin-left: -0.625rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')

<!-- Breadcrumb Navigation -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
    <nav class="flex text-sm text-stone-500 mb-6 sm:mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                    <iconify-icon icon="lucide:home" width="14" class="sm:w-4"></iconify-icon>
                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm">Home</span>
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                    <span class="ml-1 sm:ml-2 text-stone-900 font-medium text-xs sm:text-sm">Shopping Cart</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid lg:grid-cols-3 gap-6 sm:gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <!-- Cart Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3 sm:gap-0">
                <h1 class="text-xl sm:text-2xl font-semibold text-stone-900">Your Cart (<span id="cart-count-display">{{ $cart['items_count'] ?? 0 }}</span> items)</h1>
                <div class="flex items-center gap-4">
                     <button onclick="clearCart()" class="text-xs text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                        <iconify-icon icon="lucide:trash-2" width="14"></iconify-icon>
                        Clear Cart
                    </button>
                    <a href="{{ route('customer.products.shop') }}" class="text-emerald-700 hover:text-emerald-800 font-medium text-xs sm:text-sm flex items-center gap-1 w-fit">
                        <iconify-icon icon="lucide:arrow-left" width="14" class="sm:w-4"></iconify-icon>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Cart Items List -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 divide-y divide-stone-100 overflow-hidden" id="cart-items-container">
                @forelse($cart['items'] ?? [] as $item)
                    <div class="p-4 sm:p-6 cart-item-transition" id="cart-item-{{ $item['id'] }}">
                        <div class="flex gap-4 sm:gap-6">
                            <!-- Product Image -->
                            <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-lg sm:rounded-xl bg-[#F0EFEC] flex items-center justify-center p-2 sm:p-3 flex-shrink-0">
                                <img src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('assets/images/placeholder.png') }}" 
                                     alt="{{ $item['product_name'] }}" 
                                     class="w-full h-full object-contain mix-blend-multiply">
                            </div>
                            
                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-2 sm:gap-0">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-stone-900 text-sm sm:text-base truncate">{{ $item['product_name'] }}</h3>
                                        <p class="text-xs text-stone-500 mb-2">{{ $item['sku'] ?? 'N/A' }}</p>
                                        @if(!empty($item['attributes']))
                                            <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                                @foreach($item['attributes'] as $key => $value)
                                                    <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 bg-stone-100 text-stone-600 text-[10px] font-medium rounded uppercase tracking-wider">
                                                        {{ $key }}: {{ $value }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-right sm:text-left">
                                        <p class="text-base sm:text-lg font-semibold text-stone-900 mb-0.5 sm:mb-1">₹{{ number_format($item['unit_price'] ?? ($item['total'] / $item['quantity']), 2) }}</p>
                                    </div>
                                </div>
                                
                                <!-- Quantity Controls -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-3 sm:mt-4 gap-3 sm:gap-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center border border-stone-300 rounded-lg overflow-hidden">
                                            <button onclick="changeQuantity('{{ $item['id'] }}', -1)" 
                                                    class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-stone-600 hover:bg-stone-50 transition-colors"
                                                    id="minus-btn-{{ $item['id'] }}"
                                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <iconify-icon icon="lucide:minus" width="14" class="sm:w-4"></iconify-icon>
                                            </button>
                                            <span class="w-10 h-8 sm:w-12 sm:h-10 flex items-center justify-center font-medium text-stone-900 border-x border-stone-300 text-sm" 
                                                  id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                            <button onclick="changeQuantity('{{ $item['id'] }}', 1)" 
                                                    class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-stone-600 hover:bg-stone-50 transition-colors"
                                                    id="plus-btn-{{ $item['id'] }}">
                                                <iconify-icon icon="lucide:plus" width="14" class="sm:w-4"></iconify-icon>
                                            </button>
                                        </div>
                                        <button onclick="removeCartItem('{{ $item['id'] }}')" class="text-xs sm:text-sm text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                                            <iconify-icon icon="lucide:trash-2" width="12" class="sm:w-3.5"></iconify-icon>
                                            Remove
                                        </button>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-base sm:text-lg font-bold text-stone-900" id="subtotal-{{ $item['id'] }}">₹{{ number_format($item['total'], 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 sm:p-8 md:p-12 text-center">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-stone-100 flex items-center justify-center">
                            <iconify-icon icon="lucide:shopping-cart" width="24" class="sm:w-8 text-stone-400"></iconify-icon>
                        </div>
                        <h3 class="text-base sm:text-lg font-medium text-stone-900 mb-2">Your cart is empty</h3>
                        <p class="text-stone-500 text-sm sm:text-base mb-4 sm:mb-6">Add some Ayurvedic goodness to get started!</p>
                        <a href="{{ route('customer.products.shop') }}" class="inline-flex items-center px-5 py-2.5 sm:px-6 sm:py-3 bg-emerald-900 text-white font-medium rounded-lg hover:bg-emerald-800 transition-colors text-sm sm:text-base">
                            <iconify-icon icon="lucide:shopping-bag" width="16" class="sm:w-5 mr-2"></iconify-icon>
                            Start Shopping
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Coupon Code -->
            <div class="mt-4 sm:mt-6 bg-stone-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-stone-200">
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <div class="flex-1">
                        <input type="text" id="coupon-code" 
                               placeholder="Enter coupon code" 
                               value="{{ $cart['coupon_code'] ?? '' }}"
                               class="w-full bg-white border border-stone-300 rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 {{ ($cart['coupon_code'] ?? null) ? 'border-emerald-500' : '' }}">
                    </div>
                    @if($cart['coupon_code'] ?? null)
                        <button onclick="removeCoupon()" id="coupon-btn" class="px-5 sm:px-6 py-2.5 sm:py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors text-sm sm:text-base">
                            Remove
                        </button>
                    @else
                        <button onclick="applyCoupon()" id="coupon-btn" class="px-5 sm:px-6 py-2.5 sm:py-3 bg-emerald-900 text-white font-medium rounded-lg hover:bg-emerald-800 transition-colors text-sm sm:text-base">
                            Apply Coupon
                        </button>
                    @endif
                </div>
                <div class="mt-3 sm:mt-4 text-xs sm:text-sm text-stone-500">
                    <p id="coupon-message">
                        @if($cart['coupon_code'] ?? null)
                            <span class="text-emerald-700 font-medium font-bold uppercase">"{{ $cart['coupon_code'] }}" Applied!</span>
                        @else
                            Available coupons: <span class="text-emerald-700 font-medium">AYURVEDA15</span> (15% off), <span class="text-emerald-700 font-medium">FIRSTORDER20</span> (20% off first order)
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="lg:sticky lg:top-24">
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 shadow-sm">
                    <h2 class="text-lg sm:text-xl font-semibold text-stone-900 mb-4 sm:mb-6">Order Summary</h2>
                    
                    <div class="space-y-3 sm:space-y-4 mb-4 sm:mb-6">
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base">
                            <span>Subtotal (<span id="item-count-summary">{{ $cart['items_count'] ?? 0 }}</span> items)</span>
                            <span class="font-medium text-stone-900" id="order-subtotal">₹{{ number_format($cart['subtotal'] ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base">
                            <span>Shipping</span>
                            <span class="font-medium text-green-600" id="order-shipping">FREE</span>
                        </div>
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base" id="tax-row">
                             <span>Tax total</span>
                            <span class="font-medium text-stone-900" id="order-tax">₹{{ number_format($cart['tax_total'] ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base {{ ($cart['discount_total'] ?? 0) > 0 ? '' : 'hidden' }}" id="discount-row">
                            <span>Discount</span>
                            <span class="font-medium text-red-600" id="order-discount">-₹{{ number_format($cart['discount_total'] ?? 0, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-stone-200 pt-4 mb-6">
                        <div class="flex justify-between text-xl font-bold text-stone-900">
                            <span>Total</span>
                            <span id="order-total" class="text-emerald-800">₹{{ number_format($cart['grand_total'] ?? 0, 2) }}</span>
                        </div>
                        <p class="text-xs text-stone-500 mt-2">Including all taxes and shipping fees</p>
                    </div>
                    
                    @if(($cart['items_count'] ?? 0) > 0)
                        <button onclick="window.location.href='{{ route('customer.checkout.index') }}'" 
                                id="checkout-btn" 
                                class="block w-full bg-emerald-900 text-white text-center font-bold py-4 rounded-xl hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10 mb-4">
                            Proceed to Checkout
                        </button>
                    @else
                        <button disabled 
                                id="checkout-btn" 
                                class="block w-full bg-stone-200 text-stone-400 text-center font-bold py-4 rounded-xl cursor-not-allowed mb-4">
                            Proceed to Checkout
                        </button>
                    @endif
                    
                    <div class="text-center">
                        <a href="{{ route('customer.products.shop') }}" class="text-xs sm:text-sm text-emerald-700 hover:text-emerald-800 font-semibold border-b border-emerald-700/30 pb-0.5">
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Safety Assurance -->
                <div class="mt-6 bg-emerald-50/50 rounded-2xl p-6 border border-emerald-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center flex-shrink-0 text-white shadow-lg shadow-emerald-600/20">
                            <iconify-icon icon="lucide:shield-check" width="20"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-bold text-stone-900 text-sm">Safe & Secure Payment</h4>
                            <p class="text-xs text-stone-500">Industry standard 256-bit SSL encryption</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach(['No Hidden Charges', 'Easy 30-day Returns', 'Free Delivery over ₹999'] as $perk)
                        <div class="flex items-center gap-3 text-stone-600 text-xs">
                            <iconify-icon icon="lucide:check-circle-2" width="14" class="text-emerald-600"></iconify-icon>
                            <span>{{ $perk }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations -->
    @if(count($recommendedProducts ?? []) > 0)
    <div class="mt-12 md:mt-16">
        <h3 class="text-xl font-bold text-stone-900 mb-6 flex items-center gap-2">
            <iconify-icon icon="lucide:sparkles" class="text-emerald-600"></iconify-icon>
            Frequently Bought Together
        </h3>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($recommendedProducts as $product)
            <div class="bg-white rounded-xl border border-stone-100 p-4 hover:shadow-xl transition-shadow group relative">
                <a href="{{ route('customer.products.details', $product['slug']) }}" class="block mb-4">
                    <div class="aspect-square bg-[#F0EFEC] rounded-lg overflow-hidden flex items-center justify-center p-4">
                        <img src="{{ !empty($product['main_image']) ? asset('storage/' . $product['main_image']) : asset('assets/images/placeholder.png') }}" 
                             alt="{{ $product['name'] }}" 
                             class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                    </div>
                </a>
                <h4 class="font-medium text-stone-900 text-sm mb-1 truncate">{{ $product['name'] }}</h4>
                <div class="flex items-center justify-between mt-auto">
                    <p class="font-bold text-emerald-800">₹{{ number_format($product['price'], 2) }}</p>
                    <button class="add-to-cart-api text-emerald-700 p-2 rounded-full hover:bg-emerald-50 transition-colors" 
                            data-variant-id="{{ $product['id'] }}" 
                            title="Add to cart">
                        <iconify-icon icon="lucide:shopping-cart" width="18"></iconify-icon>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Notification Toast -->
<div id="notificationToast" class="fixed bottom-6 right-6 z-[100] transform translate-y-20 opacity-0 transition-all duration-300">
    <div class="bg-stone-900 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3">
        <div id="toastIcon">
            <iconify-icon icon="lucide:check-circle" width="24" class="text-emerald-400"></iconify-icon>
        </div>
        <span id="toastMessage" class="font-medium text-sm">Action successful!</span>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Axios Setup
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;

    // Toast Utility
    function showToast(message, type = 'success') {
        const toast = document.getElementById('notificationToast');
        const toastMsg = document.getElementById('toastMessage');
        const toastIcon = document.getElementById('toastIcon');
        
        toastMsg.textContent = message;
        toastIcon.innerHTML = type === 'error' 
            ? '<iconify-icon icon="lucide:alert-circle" width="24" class="text-red-400"></iconify-icon>'
            : '<iconify-icon icon="lucide:check-circle" width="24" class="text-emerald-400"></iconify-icon>';
        
        toast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => toast.classList.add('translate-y-20', 'opacity-0'), 3000);
    }

    // Format Currency
    function formatINR(sum) {
        return '₹' + new Intl.NumberFormat('en-IN', { minimumFractionDigits: 2 }).format(sum);
    }

    // Reload or Update Logic
    function handleResponse(data) {
        if (data.cart) {
            updateSummary(data.cart);
            if (window.updateCartCount) window.updateCartCount(data.cart_count);
        } else {
            window.location.reload();
        }
    }

    // Update Totals UI
    function updateSummary(cart) {
        document.getElementById('cart-count-display').textContent = cart.items_count;
        document.getElementById('item-count-summary').textContent = cart.items_count;
        document.getElementById('order-subtotal').textContent = formatINR(cart.subtotal);
        document.getElementById('order-tax').textContent = formatINR(cart.tax_total);
        document.getElementById('order-total').textContent = formatINR(cart.grand_total);
        
        const discountRow = document.getElementById('discount-row');
        if (cart.discount_total > 0) {
            discountRow.classList.remove('hidden');
            document.getElementById('order-discount').textContent = '- ' + formatINR(cart.discount_total);
        } else {
            discountRow.classList.add('hidden');
        }

        const checkoutBtn = document.getElementById('checkout-btn');
        if (cart.items_count > 0) {
            checkoutBtn.disabled = false;
            checkoutBtn.className = "block w-full bg-emerald-900 text-white text-center font-bold py-4 rounded-xl hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10 mb-4";
        } else {
            checkoutBtn.disabled = true;
            checkoutBtn.className = "block w-full bg-stone-200 text-stone-400 text-center font-bold py-4 rounded-xl cursor-not-allowed mb-4";
            window.location.reload(); // To show empty state
        }
    }

    // API Calls
    async function changeQuantity(itemId, delta) {
        const qtyEl = document.getElementById(`quantity-${itemId}`);
        const current = parseInt(qtyEl.textContent);
        const next = current + delta;
        
        if (next < 1) return removeCartItem(itemId);
        
        try {
            const response = await axios.put(`/cart/update/${itemId}`, { quantity: next });
            if (response.data.success) {
                const updatedItems = response.data.data.cart.items;
                const updatedItem = updatedItems.find(i => i.id == itemId);
                
                qtyEl.textContent = updatedItem.quantity;
                document.getElementById(`subtotal-${itemId}`).textContent = formatINR(updatedItem.total);
                document.getElementById(`minus-btn-${itemId}`).disabled = updatedItem.quantity <= 1;
                
                updateSummary(response.data.data.cart);
            }
        } catch (error) {
            showToast(error.response?.data?.message || 'Update failed', 'error');
        }
    }

    async function removeCartItem(itemId) {
        const result = await Swal.fire({
            title: 'Remove Item?',
            text: "Are you sure you want to remove this item from your cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#065f46',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        });

        if (!result.isConfirmed) return;

        const itemRow = document.getElementById(`cart-item-${itemId}`);
        
        try {
            itemRow.style.opacity = '0.5';
            const response = await axios.delete(`/cart/remove/${itemId}`);
            if (response.data.success) {
                itemRow.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    itemRow.remove();
                    updateSummary(response.data.data.cart);
                    Swal.fire({
                        title: 'Removed!',
                        text: 'Item has been removed from your cart.',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }, 300);
            }
        } catch (error) {
             itemRow.style.opacity = '1';
             showToast('Failed to remove item', 'error');
        }
    }

    async function applyCoupon() {
        const code = document.getElementById('coupon-code').value.trim();
        const btn = document.getElementById('coupon-btn');
        if (!code) return showToast('Enter code', 'error');
        
        btn.classList.add('btn-loading');
        try {
            const response = await axios.post('/cart/apply-coupon', { coupon_code: code });
            if (response.data.success) {
                showToast('Coupon applied!');
                window.location.reload();
            } else {
                showToast(response.data.message, 'error');
            }
        } catch (error) {
            showToast(error.response?.data?.message || 'Invalid coupon', 'error');
        } finally {
            btn.classList.remove('btn-loading');
        }
    }

    async function removeCoupon() {
        const btn = document.getElementById('coupon-btn');
        btn.classList.add('btn-loading');
        try {
            const response = await axios.post('/cart/remove-coupon');
            if (response.data.success) {
                window.location.reload();
            }
        } catch (error) {
            showToast('Failed to remove coupon', 'error');
        } finally {
            btn.classList.remove('btn-loading');
        }
    }

    async function clearCart() {
        const result = await Swal.fire({
            title: 'Clear Cart?',
            text: "Are you sure you want to remove all items from your cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#065f46',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear it!'
        });

        if (!result.isConfirmed) return;

        try {
            const response = await axios.delete('/cart/clear');
            if (response.data.success) {
                Swal.fire({
                    title: 'Cleared!',
                    text: 'Your cart is now empty.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            }
        } catch (error) {
            showToast('Failed to clear cart', 'error');
        }
    }

    // Recommendation Add to Cart
    document.querySelectorAll('.add-to-cart-api').forEach(btn => {
        btn.onclick = async () => {
            const id = btn.dataset.variantId;
            btn.innerHTML = '<iconify-icon icon="lucide:loader-2" class="animate-spin" width="18"></iconify-icon>';
            try {
                const response = await axios.post('/cart/add', { variant_id: id, quantity: 1 });
                if (response.data.success) {
                    showToast('Item added!');
                    window.location.reload(); // Easy reload to refresh cart items
                }
            } catch (error) {
                showToast('Failed to add item', 'error');
                btn.innerHTML = '<iconify-icon icon="lucide:shopping-cart" width="18"></iconify-icon>';
            }
        };
    });
</script>
@endpush
