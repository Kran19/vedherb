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
                <h1 class="text-xl sm:text-2xl font-semibold text-stone-900">Your Cart (<span id="cart-count">0</span> items)</h1>
                <a href="{{ route('customer.products.shop') }}" class="text-emerald-700 hover:text-emerald-800 font-medium text-xs sm:text-sm flex items-center gap-1 w-fit">
                    <iconify-icon icon="lucide:arrow-left" width="14" class="sm:w-4"></iconify-icon>
                    Continue Shopping
                </a>
            </div>

            <!-- Cart Items List -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 divide-y divide-stone-100" id="cart-items-container">
                <!-- Empty cart message will be shown by default -->
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
            </div>

            <!-- Coupon Code -->
            <div class="mt-4 sm:mt-6 bg-stone-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-stone-200">
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <div class="flex-1">
                        <input type="text" id="coupon-code" 
                               placeholder="Enter coupon code" 
                               class="w-full bg-white border border-stone-300 rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                    </div>
                    <button id="apply-coupon" class="px-5 sm:px-6 py-2.5 sm:py-3 bg-emerald-900 text-white font-medium rounded-lg hover:bg-emerald-800 transition-colors text-sm sm:text-base">
                        Apply Coupon
                    </button>
                </div>
                <div class="mt-3 sm:mt-4 text-xs sm:text-sm text-stone-500">
                    <p id="coupon-message">Available coupons: <span class="text-emerald-700 font-medium">AYURVEDA15</span> (15% off), <span class="text-emerald-700 font-medium">FIRSTORDER20</span> (20% off first order)</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="lg:sticky lg:top-24">
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6">
                    <h2 class="text-lg sm:text-xl font-semibold text-stone-900 mb-4 sm:mb-6">Order Summary</h2>
                    
                    <div class="space-y-3 sm:space-y-4 mb-4 sm:mb-6">
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base">
                            <span>Subtotal (<span id="item-count">0</span> items)</span>
                            <span class="font-medium" id="subtotal">₹0.00</span>
                        </div>
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base">
                            <span>Shipping</span>
                            <span class="font-medium text-green-600" id="shipping">FREE</span>
                        </div>
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base">
                            <span>Tax (18% GST)</span>
                            <span class="font-medium" id="tax">₹0.00</span>
                        </div>
                        <div class="flex justify-between text-stone-600 text-sm sm:text-base hidden" id="discount-row">
                            <span>Discount <span class="text-red-600" id="discount-percent"></span></span>
                            <span class="font-medium text-red-600" id="discount">-₹0.00</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-stone-200 pt-3 sm:pt-4 mb-4 sm:mb-6">
                        <div class="flex justify-between text-base sm:text-lg font-semibold text-stone-900">
                            <span>Total</span>
                            <span id="total">₹0.00</span>
                        </div>
                        <p class="text-xs sm:text-sm text-stone-500 mt-1">Including all taxes</p>
                        <p class="text-xs text-emerald-600 mt-1">Free shipping on orders above ₹999</p>
                    </div>
                    
                    <button id="checkout-btn" disabled class="block w-full bg-stone-300 text-stone-500 text-center font-semibold py-3 sm:py-4 rounded-xl cursor-not-allowed mb-3 sm:mb-4 text-sm sm:text-base">
                        Proceed to Checkout
                    </button>
                    
                    <div class="text-center">
                        <p class="text-xs sm:text-sm text-stone-500 mb-2 sm:mb-3">or</p>
                        <a href="{{ route('customer.products.shop') }}" class="text-xs sm:text-sm text-emerald-700 hover:text-emerald-800 font-medium">
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Safety Assurance -->
                <div class="mt-4 sm:mt-6 bg-emerald-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border border-emerald-200">
                    <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:shield-check" width="14" class="sm:w-4 text-emerald-700"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-medium text-emerald-800 text-sm sm:text-base">Safe & Secure Checkout</h4>
                            <p class="text-xs text-emerald-700">256-bit SSL encryption</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 sm:space-y-3 text-xs sm:text-sm">
                        <div class="flex items-center gap-2 text-emerald-700">
                            <iconify-icon icon="lucide:check-circle" width="12" class="sm:w-3.5"></iconify-icon>
                            <span>100% Ayurvedic & Natural</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-700">
                            <iconify-icon icon="lucide:check-circle" width="12" class="sm:w-3.5"></iconify-icon>
                            <span>Free Shipping over ₹999</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-700">
                            <iconify-icon icon="lucide:check-circle" width="12" class="sm:w-3.5"></iconify-icon>
                            <span>30-Day Money Back Guarantee</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-700">
                            <iconify-icon icon="lucide:check-circle" width="12" class="sm:w-3.5"></iconify-icon>
                            <span>Cash on Delivery Available</span>
                        </div>
                    </div>
                </div>

                <!-- Recommended Add-ons -->
                <div class="mt-4 sm:mt-6">
                    <h3 class="font-medium text-stone-900 mb-3 sm:mb-4 text-sm sm:text-base">Frequently Bought Together</h3>
                    <div class="space-y-2 sm:space-y-3">
                        <div class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 border border-stone-200 rounded-lg">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-[#F0EFEC] flex items-center justify-center p-1 flex-shrink-0">
                                <img src="https://www.vedherbsandayurveda.com/pachan-shakti.jpeg" 
                                     alt="Brahmi Gritha" 
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-stone-900 truncate">Brahmi Gritha</p>
                                <p class="text-xs text-stone-500">Brain Tonic • 50g</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs sm:text-sm font-semibold text-stone-900">₹850.00</p>
                                <p class="text-xs text-stone-500">₹17.00/g</p>
                                <button class="add-recommended text-xs text-emerald-700 hover:text-emerald-800 font-medium mt-0.5 sm:mt-1" 
                                        data-id="rec1"
                                        data-name="Brahmi Gritha" 
                                        data-price="850.00" 
                                        data-image="https://www.vedherbsandayurveda.com/pachan-shakti.jpeg" 
                                        data-weight="50g">
                                    Add
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 border border-stone-200 rounded-lg">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-[#F0EFEC] flex items-center justify-center p-1 flex-shrink-0">
                                <img src="https://www.vedherbsandayurveda.com/products-img/Power-Max.PNG" 
                                     alt="Performance Pills" 
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-stone-900 truncate">Unlock Your Prime</p>
                                <p class="text-xs text-stone-500">Strength & Performance • 60 capsules</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs sm:text-sm font-semibold text-stone-900">₹1,250.00</p>
                                <p class="text-xs text-stone-500">₹20.83/capsule</p>
                                <button class="add-recommended text-xs text-emerald-700 hover:text-emerald-800 font-medium mt-0.5 sm:mt-1"
                                        data-id="rec2"
                                        data-name="Unlock Your Prime" 
                                        data-price="1250.00" 
                                        data-image="https://www.vedherbsandayurveda.com/products-img/Power-Max.PNG" 
                                        data-weight="60 capsules">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format Indian Rupees
    function formatINR(amount) {
        return '₹' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
    
    // Format per unit price
    function formatUnitPrice(price, weight) {
        const unit = weight.includes('capsules') ? 'capsule' : 'g';
        const unitValue = weight.includes('capsules') ? 
            parseInt(weight) : 
            parseFloat(weight.replace('g', ''));
        
        if (unitValue > 0) {
            const perUnit = (price / unitValue).toFixed(2);
            return `₹${perUnit}/${unit}`;
        }
        return '';
    }

    // Initialize cart in localStorage if not exists
    if (!localStorage.getItem('cart')) {
        localStorage.setItem('cart', JSON.stringify([]));
    }
    
    // Initialize coupon in localStorage if not exists
    if (!localStorage.getItem('coupon')) {
        localStorage.setItem('coupon', '');
    }
    
    // Load cart data
    loadCart();
    
    // Apply coupon button
    document.getElementById('apply-coupon').addEventListener('click', function() {
        const couponCode = document.getElementById('coupon-code').value.trim().toUpperCase();
        const validCoupons = ['AYURVEDA15', 'FIRSTORDER20'];
        
        if (validCoupons.includes(couponCode)) {
            localStorage.setItem('coupon', couponCode);
            document.getElementById('coupon-message').innerHTML = 
                `<span class="text-green-600 font-medium">Coupon "${couponCode}" applied successfully!</span>`;
            updateCartTotals();
        } else {
            localStorage.setItem('coupon', '');
            document.getElementById('coupon-message').innerHTML = 
                'Invalid coupon code. Available coupons: <span class="text-emerald-700 font-medium">AYURVEDA15</span> (15% off), <span class="text-emerald-700 font-medium">FIRSTORDER20</span> (20% off first order)';
        }
    });
    
    // Load saved coupon
    const savedCoupon = localStorage.getItem('coupon');
    if (savedCoupon) {
        document.getElementById('coupon-code').value = savedCoupon;
        document.getElementById('coupon-message').innerHTML = 
            `<span class="text-green-600 font-medium">Coupon "${savedCoupon}" applied!</span>`;
    }
    
    // Add recommended items
    document.querySelectorAll('.add-recommended').forEach(button => {
        button.addEventListener('click', function() {
            const product = {
                id: this.getAttribute('data-id'),
                name: this.getAttribute('data-name'),
                price: parseFloat(this.getAttribute('data-price')),
                image: this.getAttribute('data-image'),
                weight: this.getAttribute('data-weight')
            };
            
            addToCart(product);
        });
    });
    
    // Load cart items
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const container = document.getElementById('cart-items-container');
        
        if (cart.length === 0) {
            container.innerHTML = `
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
            `;
            updateCartTotals();
            return;
        }
        
        let html = '';
        cart.forEach((item, index) => {
            const unitPrice = formatUnitPrice(item.price, item.weight);
            
            html += `
                <div class="p-4 sm:p-6 cart-item" data-index="${index}">
                    <div class="flex gap-4 sm:gap-6">
                        <!-- Product Image -->
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-lg sm:rounded-xl bg-[#F0EFEC] flex items-center justify-center p-2 sm:p-3 flex-shrink-0">
                            <img src="${item.image}" 
                                 alt="${item.name}" 
                                 class="w-full h-full object-contain">
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2 sm:gap-0">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-stone-900 text-sm sm:text-base truncate">${item.name}</h3>
                                    <p class="text-xs text-stone-500 mb-2">${item.weight}</p>
                                    <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded">Vata Balancing</span>
                                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">Stress Relief</span>
                                    </div>
                                </div>
                                <div class="text-right sm:text-left">
                                    <p class="text-base sm:text-lg font-semibold text-stone-900 mb-0.5 sm:mb-1">${formatINR(item.price)}</p>
                                    ${unitPrice ? `<p class="text-xs text-stone-500">${unitPrice}</p>` : ''}
                                </div>
                            </div>
                            
                            <!-- Quantity Controls -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-3 sm:mt-4 gap-3 sm:gap-0">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center border border-stone-300 rounded-lg">
                                        <button class="quantity-minus w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-stone-600 hover:bg-stone-50" data-index="${index}">
                                            <iconify-icon icon="lucide:minus" width="14" class="sm:w-4"></iconify-icon>
                                        </button>
                                        <input type="number" class="quantity-input w-10 h-8 sm:w-12 sm:h-10 text-center font-medium text-stone-900 border-x border-stone-300 text-sm" 
                                               value="${item.quantity}" min="1" max="10" data-index="${index}">
                                        <button class="quantity-plus w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-stone-600 hover:bg-stone-50" data-index="${index}">
                                            <iconify-icon icon="lucide:plus" width="14" class="sm:w-4"></iconify-icon>
                                        </button>
                                    </div>
                                    <button class="remove-item text-xs sm:text-sm text-red-600 hover:text-red-700 font-medium flex items-center gap-1" data-index="${index}">
                                        <iconify-icon icon="lucide:trash-2" width="12" class="sm:w-3.5"></iconify-icon>
                                        Remove
                                    </button>
                                </div>
                                <div class="text-right sm:text-left">
                                    <p class="text-base sm:text-lg font-semibold text-stone-900">${formatINR(item.price * item.quantity)}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
        
        // Add event listeners
        addCartEventListeners();
        updateCartTotals();
    }
    
    // Add cart event listeners
    function addCartEventListeners() {
        // Quantity minus
        document.querySelectorAll('.quantity-minus').forEach(button => {
            button.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                updateQuantity(index, -1);
            });
        });
        
        // Quantity plus
        document.querySelectorAll('.quantity-plus').forEach(button => {
            button.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                updateQuantity(index, 1);
            });
        });
        
        // Quantity input change
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const index = parseInt(this.getAttribute('data-index'));
                const newQuantity = parseInt(this.value);
                if (newQuantity >= 1 && newQuantity <= 10) {
                    updateQuantity(index, 0, newQuantity);
                }
            });
        });
        
        // Remove item
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                removeFromCart(index);
            });
        });
    }
    
    // Update quantity
    function updateQuantity(index, change, newQuantity = null) {
        const cart = JSON.parse(localStorage.getItem('cart'));
        
        if (newQuantity !== null) {
            cart[index].quantity = newQuantity;
        } else {
            cart[index].quantity += change;
            if (cart[index].quantity < 1) cart[index].quantity = 1;
            if (cart[index].quantity > 10) cart[index].quantity = 10;
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Update UI
        const input = document.querySelector(`.quantity-input[data-index="${index}"]`);
        if (input) input.value = cart[index].quantity;
        
        updateCartTotals();
        updateHeaderCartCount();
    }
    
    // Remove item from cart
    function removeFromCart(index) {
        const cart = JSON.parse(localStorage.getItem('cart'));
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Reload cart
        loadCart();
        updateHeaderCartCount();
    }
    
    // Add item to cart
    function addToCart(product) {
        const cart = JSON.parse(localStorage.getItem('cart'));
        
        // Check if item already exists
        const existingIndex = cart.findIndex(item => 
            item.id === product.id
        );
        
        if (existingIndex > -1) {
            cart[existingIndex].quantity += 1;
        } else {
            cart.push({
                ...product,
                quantity: 1
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Reload cart
        loadCart();
        updateHeaderCartCount();
        
        // Show success message
        showSuccessMessage(`${product.name} added to cart!`);
    }
    
    // Update cart totals
    function updateCartTotals() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Calculate subtotal
        let subtotal = 0;
        let itemCount = 0;
        
        cart.forEach(item => {
            subtotal += item.price * item.quantity;
            itemCount += item.quantity;
        });
        
        // Calculate shipping (free over ₹999)
        const shipping = subtotal > 999 ? 0 : 99;
        
        // Calculate tax (18% GST)
        const tax = subtotal * 0.18;
        
        // Calculate discount
        const coupon = localStorage.getItem('coupon');
        let discountRate = 0;
        if (coupon === 'AYURVEDA15') discountRate = 0.15;
        if (coupon === 'FIRSTORDER20') discountRate = 0.20;
        
        const discount = subtotal * discountRate;
        
        // Calculate total
        const total = subtotal + shipping + tax - discount;
        
        // Update UI
        document.getElementById('cart-count').textContent = itemCount;
        document.getElementById('item-count').textContent = itemCount;
        document.getElementById('subtotal').textContent = formatINR(subtotal);
        document.getElementById('shipping').textContent = shipping === 0 ? 'FREE' : formatINR(shipping);
        document.getElementById('shipping').className = shipping === 0 ? 'font-medium text-green-600' : 'font-medium';
        document.getElementById('tax').textContent = formatINR(tax);
        
        // Update discount row
        const discountRow = document.getElementById('discount-row');
        if (discount > 0) {
            discountRow.classList.remove('hidden');
            document.getElementById('discount-percent').textContent = `(-${(discountRate * 100)}%)`;
            document.getElementById('discount').textContent = '-' + formatINR(discount);
        } else {
            discountRow.classList.add('hidden');
        }
        
        document.getElementById('total').textContent = formatINR(total);
        
        // Update checkout button
        const checkoutBtn = document.getElementById('checkout-btn');
        if (itemCount > 0) {
            checkoutBtn.disabled = false;
            checkoutBtn.className = 'block w-full bg-emerald-900 text-white text-center font-semibold py-3 sm:py-4 rounded-xl hover:bg-emerald-800 transition-colors mb-3 sm:mb-4 text-sm sm:text-base';
            checkoutBtn.textContent = 'Proceed to Checkout';
            checkoutBtn.onclick = function() {
                window.location.href = '{{ route("customer.checkout") }}';
            };
        } else {
            checkoutBtn.disabled = true;
            checkoutBtn.className = 'block w-full bg-stone-300 text-stone-500 text-center font-semibold py-3 sm:py-4 rounded-xl cursor-not-allowed mb-3 sm:mb-4 text-sm sm:text-base';
            checkoutBtn.textContent = 'Proceed to Checkout';
            checkoutBtn.onclick = null;
        }
    }
    
    // Update header cart count
    function updateHeaderCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalItems = 0;
        cart.forEach(item => {
            totalItems += item.quantity;
        });
        
        // Update header badge
        const headerCartLink = document.querySelector('a[href="{{ route("customer.cart") }}"]');
        let badge = headerCartLink.querySelector('.cart-badge');
        
        if (totalItems > 0) {
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'cart-badge absolute -top-1.5 -right-1.5 sm:-top-2 sm:-right-2 flex items-center justify-center min-w-[16px] h-4 sm:min-w-[20px] sm:h-5 px-1 bg-emerald-500 text-white text-[10px] sm:text-xs font-medium rounded-full';
                headerCartLink.appendChild(badge);
            }
            badge.innerHTML = `
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative">${totalItems}</span>
            `;
        } else if (badge) {
            badge.remove();
        }
    }
    
    // Show success message
    function showSuccessMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'fixed top-20 sm:top-24 right-4 sm:right-6 z-50 bg-emerald-100 border border-emerald-300 text-emerald-800 px-3 sm:px-4 py-2 sm:py-3 rounded-lg shadow-lg flex items-center gap-2 animate-fade-in-down text-sm sm:text-base';
        messageDiv.innerHTML = `
            <iconify-icon icon="lucide:check-circle" width="16" class="sm:w-5 text-emerald-600"></iconify-icon>
            <span>${message}</span>
        `;
        
        document.body.appendChild(messageDiv);
        
        setTimeout(() => {
            messageDiv.style.opacity = '0';
            messageDiv.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                messageDiv.remove();
            }, 300);
        }, 3000);
    }
    
    // Initialize header cart count on page load
    updateHeaderCartCount();
});
</script>
@endpush
