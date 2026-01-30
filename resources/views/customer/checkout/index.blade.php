@extends('customer.layouts.master')

@section('title', 'Checkout - ' . config('app.name'))

@section('content')
    <!-- ============================================
                   CHECKOUT HERO SECTION
                   ============================================ -->
    <section class="relative bg-gradient-to-b from-stone-50 to-stone-100 py-12 md:py-20 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-stone-200/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-stone-300/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('customer.home.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-stone-900">
                                <i class="fas fa-home mr-2"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <a href="{{ route('customer.cart') }}"
                                    class="ml-1 text-sm font-medium text-gray-700 hover:text-stone-900 md:ml-2">Cart</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Checkout</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Hero Content -->
            <div class="text-center">
                <div class="inline-flex items-center gap-3 mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-transparent via-stone-500 to-transparent"></div>
                    <span class="text-sm font-semibold tracking-widest text-stone-700">SECURE CHECKOUT</span>
                    <div class="w-16 h-1 bg-gradient-to-r from-transparent via-stone-500 to-transparent"></div>
                </div>

                <h1 class="text-4xl md:text-6xl font-serif text-gray-800 mb-6">
                    Checkout
                </h1>

                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Complete your order securely in a few simple steps.
                </p>
            </div>
        </div>
    </section>

    <!-- ============================================
                   CHECKOUT PROCESS
                   ============================================ -->
    <section class="pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Checkout Steps -->
            <div class="mb-12">
                <div class="flex justify-center px-4">
                    <div class="flex items-center gap-4 md:gap-0">
                        <!-- Cart -->
                        <div class="flex flex-col items-center shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-stone-800 text-white rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-shopping-cart text-sm"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-800">Cart</span>
                        </div>
                        <div class="w-8 md:w-20 h-0.5 bg-stone-800"></div>

                        <!-- Details -->
                        <div class="flex flex-col items-center shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-stone-800 text-white rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-800">Details</span>
                        </div>
                        <div class="w-8 md:w-20 h-0.5 bg-stone-300"></div>

                        <!-- Shipping -->
                        <div class="flex flex-col items-center shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-stone-100 text-stone-400 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-truck text-sm"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-400">Shipping</span>
                        </div>
                        <div class="w-8 md:w-20 h-0.5 bg-stone-100"></div>

                        <!-- Payment -->
                        <div class="flex flex-col items-center shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-stone-50 text-stone-300 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-credit-card text-sm"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-300">Payment</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($cart['items'] ?? []) === 0)
                <!-- Empty Cart Message -->
                <div class="text-center py-20 bg-stone-50 rounded-3xl border border-dashed border-stone-200">
                    <div class="mb-6">
                        <i class="fas fa-shopping-cart text-stone-200 text-6xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Your cart is empty</h3>
                    <p class="text-gray-600 mb-8">Please add items to your cart before proceeding to checkout.</p>
                    <a href="{{ route('customer.products.shop') }}"
                        class="inline-flex items-center gap-2 bg-stone-800 text-white px-8 py-3 rounded-full font-bold hover:bg-stone-900 transition-all">
                        <i class="fas fa-leaf"></i>
                        Browse Shop
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Checkout Form -->
                    <div class="lg:col-span-2">
                        <form id="checkoutForm" method="POST" action="{{ route('customer.checkout.process') }}" class="space-y-8">
                            @csrf

                            @if ($errors->any())
                                <div class="p-4 rounded-xl bg-red-50 border border-red-200">
                                    <ul class="list-disc list-inside text-red-700 text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Personal Information -->
                            <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100">
                                <h2 class="text-2xl font-serif text-gray-800 mb-6">Personal Information</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                        <input type="text" name="full_name" required
                                            value="{{ auth()->guard('customer')->user()->name ?? '' }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                        <input type="email" name="email" required
                                            value="{{ auth()->guard('customer')->user()->email ?? '' }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                        <input type="tel" name="phone" required
                                            value="{{ auth()->guard('customer')->user()->mobile ?? '' }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                        <select name="country" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                            <option value="IN" selected>India</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100">
                                <h2 class="text-2xl font-serif text-gray-800 mb-6">Shipping Address</h2>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Address Line 1 *</label>
                                        <input type="text" name="address" required placeholder="House No, Street, Area"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Address Line 2 (Optional)</label>
                                        <input type="text" name="address2" placeholder="Landmark, Apartment, Suite"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                            <input type="text" name="city" required
                                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                                            <input type="text" name="state" required
                                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Pincode *</label>
                                            <input type="text" name="pincode" id="pincodeInput" required maxlength="6"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-stone-800 focus:ring-1 focus:ring-stone-800 focus:outline-none transition-all">
                                            <!-- Delivery Status Message -->
                                            <div id="delivery-status" class="mt-2 text-sm hidden"></div>
                                        </div>
                                    </div>

                                    <!-- Shipping Method Selection (Dynamic) -->
                                    <div class="mt-8 pt-6 border-t border-stone-100">
                                        <label class="block text-sm font-medium text-gray-700 mb-4">Shipping Method</label>
                                        <div id="shipping-method-container" class="space-y-3">
                                            <div class="p-4 border border-dashed border-gray-200 rounded-xl text-center text-gray-400 text-sm">
                                                <i class="fas fa-truck-loading mb-2 text-xl block"></i>
                                                Please enter your PIN code to see available shipping options.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100">
                                <h2 class="text-2xl font-serif text-gray-800 mb-6">Payment Method</h2>
                                <div class="space-y-4">
                                    <label class="flex items-center p-4 border border-stone-200 rounded-xl cursor-pointer hover:border-stone-800 transition-all group">
                                        <input type="radio" name="payment_method" value="online" checked class="w-5 h-5 text-stone-800 focus:ring-stone-800">
                                        <div class="ml-4 flex-1">
                                            <p class="font-medium text-gray-800">Online Payment</p>
                                            <p class="text-xs text-gray-500">Pay via UPI, Cards, NetBanking (Razorpay)</p>
                                        </div>
                                        <div class="flex gap-2">
                                            <i class="fab fa-cc-visa text-2xl text-blue-600"></i>
                                            <i class="fab fa-cc-mastercard text-2xl text-red-500"></i>
                                            <i class="fas fa-university text-2xl text-stone-400"></i>
                                        </div>
                                    </label>

                                    @if($codAvailable)
                                    <label class="flex items-center p-4 border border-stone-200 rounded-xl cursor-pointer hover:border-stone-800 transition-all group">
                                        <input type="radio" name="payment_method" value="cod" class="w-5 h-5 text-stone-800 focus:ring-stone-800">
                                        <div class="ml-4 flex-1">
                                            <p class="font-medium text-gray-800">Cash on Delivery</p>
                                            <p class="text-xs text-gray-500">Extra charges may apply</p>
                                        </div>
                                        <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
                                    </label>
                                    @else
                                    <div class="flex items-center p-4 border border-gray-100 bg-gray-50 rounded-xl opacity-60 cursor-not-allowed">
                                        <div class="w-5 h-5 rounded-full border border-gray-300"></div>
                                        <div class="ml-4 flex-1">
                                            <p class="font-medium text-gray-400">Cash on Delivery</p>
                                            <p class="text-xs text-red-400">Not available for these items</p>
                                        </div>
                                        <i class="fas fa-money-bill-wave text-2xl text-gray-300"></i>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Terms & Submit -->
                            <div class="bg-stone-50 rounded-2xl p-6 border border-stone-100">
                                <label class="flex items-start cursor-pointer">
                                    <input type="checkbox" name="terms_agree" required class="mt-1 w-4 h-4 text-stone-800 border-gray-300 rounded focus:ring-stone-800">
                                    <span class="ml-3 text-sm text-gray-600 leading-relaxed">
                                        I agree to the <a href="{{ route('customer.page.terms') }}" target="_blank" class="text-stone-800 underline font-medium">Terms & Conditions</a> and <a href="{{ route('customer.page.privacy') }}" target="_blank" class="text-stone-800 underline font-medium">Privacy Policy</a>.
                                    </span>
                                </label>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4 pt-4">
                                <a href="{{ route('customer.cart') }}" class="px-8 py-4 border border-stone-300 text-stone-700 rounded-full font-bold hover:bg-stone-50 transition-all text-center">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Cart
                                </a>
                                <button type="submit" id="placeOrderBtn" disabled class="flex-1 bg-stone-800 text-white py-4 rounded-full font-bold text-lg shadow-lg opacity-50 cursor-not-allowed transition-all duration-300 transform-none">
                                    <i class="fas fa-lock mr-2"></i>
                                    <span id="orderBtnText">Place Order & Pay ₹{{ number_format($cart['grand_total'], 2) }}</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-8">
                            <div class="bg-stone-50 rounded-3xl p-6 md:p-8 border border-stone-100 shadow-sm">
                                <h2 class="text-2xl font-serif text-gray-800 mb-6">Order Summary</h2>

                                <!-- Items List -->
                                <div class="space-y-4 mb-8 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                    @foreach ($cart['items'] as $item)
                                        <div class="flex items-center gap-4 pb-4 border-b border-stone-100 last:border-0">
                                            <div class="w-16 h-16 bg-white rounded-lg border border-stone-100 overflow-hidden shrink-0">
                                                <img src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('assets/images/placeholder.jpg') }}"
                                                    alt="{{ $item['product_name'] }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-gray-800 truncate">{{ $item['product_name'] }}</h4>
                                                @if(!empty($item['attributes']))
                                                <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-0.5">
                                                    @foreach($item['attributes'] as $key => $val)
                                                        {{ $key }}: {{ $val }}{{ !$loop->last ? ' | ' : '' }}
                                                    @endforeach
                                                </p>
                                                @endif
                                                <div class="flex justify-between items-center mt-1">
                                                    <span class="text-stone-800 font-bold text-sm">₹{{ number_format($item['unit_price'], 2) }}</span>
                                                    <span class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Summary Totals -->
                                <div class="space-y-4 mb-6 pt-6 border-t border-stone-200">
                                    <div class="flex justify-between text-gray-600">
                                        <span>Subtotal</span>
                                        <span class="font-medium text-gray-900">₹{{ number_format($cart['subtotal'], 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Tax</span>
                                        <span class="font-medium text-gray-900">₹{{ number_format($cart['tax_total'], 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Shipping</span>
                                        <span id="shipping-cost-display" class="font-semibold {{ $cart['shipping_total'] == 0 ? 'text-green-600' : 'text-stone-800' }}">
                                            {{ $cart['shipping_total'] == 0 ? 'FREE' : '₹' . number_format($cart['shipping_total'], 2) }}
                                        </span>
                                    </div>
                                    @if($cart['discount_total'] > 0)
                                    <div class="flex justify-between items-center text-green-600">
                                        <span>Discount</span>
                                        <span class="font-bold">-₹{{ number_format($cart['discount_total'], 2) }}</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Grand Total -->
                                <div class="pt-6 border-t border-stone-200">
                                    <div class="flex justify-between items-baseline mb-2">
                                        <span class="text-lg font-bold text-gray-800">Total Amount</span>
                                        <span id="grand-total-display" class="text-3xl font-serif text-stone-800">₹{{ number_format($cart['grand_total'], 2) }}</span>
                                    </div>
                                    <p class="text-[10px] text-gray-400 text-right uppercase tracking-tighter italic">Inclusive of all taxes & delivery</p>
                                </div>

                                <!-- Trust Badges -->
                                <div class="mt-8 grid grid-cols-3 gap-4 border-t border-stone-100 pt-6">
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto bg-stone-100 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-shield-alt text-stone-600 text-xs"></i>
                                        </div>
                                        <p class="text-[9px] uppercase font-bold text-gray-400">100% Secure</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto bg-stone-100 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-undo text-stone-600 text-xs"></i>
                                        </div>
                                        <p class="text-[9px] uppercase font-bold text-gray-400">Easy Return</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto bg-stone-100 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-medal text-stone-600 text-xs"></i>
                                        </div>
                                        <p class="text-[9px] uppercase font-bold text-gray-400">Pure Quality</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartData = @json($cart);
        const pincodeInput = document.querySelector('input[name="pincode"]');
        const checkoutForm = document.getElementById('checkoutForm');
        let shippingTimeout = null;

        // --- Form Validation Logic ---
        function validateForm() {
            if (!checkoutForm) return;
            const requiredInputs = checkoutForm.querySelectorAll('input[required], select[required]');
            let allFilled = true;
            
            requiredInputs.forEach(input => {
                if (input.type === 'checkbox') {
                    if (!input.checked) allFilled = false;
                } else {
                    if (!input.value.trim()) allFilled = false;
                }
            });

            const deliveryStatus = document.getElementById('delivery-status');
            const isDeliveryAvailable = deliveryStatus && !deliveryStatus.classList.contains('hidden') && 
                                      deliveryStatus.classList.contains('text-green-600');

            const btn = document.getElementById('placeOrderBtn');
            if (!btn) return;

            if (allFilled && isDeliveryAvailable) {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed', 'transform-none');
                btn.classList.add('hover:bg-stone-900', 'transform', 'hover:-translate-y-1');
            } else {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed', 'transform-none');
                btn.classList.remove('hover:bg-stone-900', 'transform', 'hover:-translate-y-1');
            }
        }

        // Add listeners to all inputs
        if (checkoutForm) {
            checkoutForm.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('input', validateForm);
                input.addEventListener('change', validateForm);
            });
            // Initial validation
            validateForm();
        }

        // --- Pincode & Shipping Logic ---
        if (pincodeInput) {
            pincodeInput.addEventListener('input', function() {
                clearTimeout(shippingTimeout);
                const pincode = this.value;
                
                // Reset delivery status on change before re-check
                const deliveryStatus = document.getElementById('delivery-status');
                deliveryStatus.classList.add('hidden');
                deliveryStatus.classList.remove('text-green-600');
                validateForm();

                if (pincode.length === 6) {
                    shippingTimeout = setTimeout(() => checkShipping(pincode), 500);
                }
            });
        }

        async function checkShipping(pincode) {
            const container = document.getElementById('shipping-method-container');
            const deliveryStatus = document.getElementById('delivery-status');
            
            container.innerHTML = '<div class="flex items-center justify-center p-4 text-stone-400"><i class="fas fa-circle-notch fa-spin mr-2"></i> Checking delivery availability...</div>';
            deliveryStatus.classList.add('hidden');
            
            try {
                const response = await fetch("{{ route('customer.checkout.shipping.check') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ pincode: pincode })
                });

                const data = await response.json();
                
                if (data.success && data.available_couriers && data.available_couriers.length > 0) {
                    // Show success delivery message
                    deliveryStatus.className = 'mt-2 text-sm text-green-600 font-medium flex items-center';
                    deliveryStatus.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Delivery available!';
                    deliveryStatus.classList.remove('hidden');
                    
                    // Show fixed standard shipping instead of dynamic options
                    renderFixedShipping();
                } else {
                    // Show error delivery message
                    deliveryStatus.className = 'mt-2 text-sm text-red-600 font-medium flex items-center';
                    deliveryStatus.innerHTML = '<i class="fas fa-times-circle mr-2"></i> Delivery not available for this pincode';
                    deliveryStatus.classList.remove('hidden');
                    
                    container.innerHTML = `<div class="p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-100">
                        <i class="fas fa-exclamation-triangle mr-2"></i> ${data.message || 'Shipping not available for this pincode.'}
                    </div>`;
                }
            } catch (error) {
                console.error('Shipping check error:', error);
                deliveryStatus.className = 'mt-2 text-sm text-red-600 font-medium flex items-center';
                deliveryStatus.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Error checking delivery availability';
                deliveryStatus.classList.remove('hidden');
                
                container.innerHTML = '<div class="p-4 text-red-500 text-sm">Error checking serviceability. Please try again.</div>';
            } finally {
                validateForm(); // Re-validate after shipping check
            }
        }

        function renderFixedShipping() {
            const container = document.getElementById('shipping-method-container');
            container.innerHTML = `
                <label class="flex items-center p-4 border border-stone-200 rounded-xl cursor-pointer hover:border-stone-800 transition-all">
                    <input type="radio" name="shipping_method_id" value="standard" checked 
                        data-rate="99" class="w-4 h-4 text-stone-800 focus:ring-stone-800 courier-option">
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-800">Standard Delivery</p>
                        <p class="text-[10px] text-gray-500">Estimated delivery: 3-5 days</p>
                    </div>
                    <span class="font-bold text-stone-800">₹99.00</span>
                </label>
            `;

            // Update totals with fixed shipping rate
            updateTotals(99);

            // Add change listener (though there's only one option)
            const radio = container.querySelector('.courier-option');
            if (radio) {
                radio.addEventListener('change', (e) => updateTotals(e.target.dataset.rate));
            }
        }

        function renderShippingOptions(couriers) {
            const container = document.getElementById('shipping-method-container');
            container.innerHTML = '';
            
            couriers.forEach((courier, index) => {
                const checked = index === 0 ? 'checked' : '';
                const option = `
                    <label class="flex items-center p-4 border border-stone-200 rounded-xl cursor-pointer hover:border-stone-800 transition-all">
                        <input type="radio" name="shipping_method_id" value="${courier.courier_id}" ${checked} 
                            data-rate="${courier.rate}" class="w-4 h-4 text-stone-800 focus:ring-stone-800 courier-option">
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-800">${courier.name} (${courier.service_type})</p>
                            <p class="text-[10px] text-gray-500">Estimated delivery: ${courier.estimated_days} days</p>
                        </div>
                        <span class="font-bold text-stone-800">₹${parseFloat(courier.rate).toFixed(2)}</span>
                    </label>
                `;
                container.insertAdjacentHTML('beforeend', option);
            });

            // Update initial total if first option is checked
            const selected = container.querySelector('input:checked');
            if (selected) updateTotals(selected.dataset.rate);

            // Add change listener
            container.querySelectorAll('.courier-option').forEach(radio => {
                radio.addEventListener('change', (e) => updateTotals(e.target.dataset.rate));
            });
        }

        function updateTotals(shippingRate) {
            shippingRate = parseFloat(shippingRate);
            const subtotal = parseFloat(cartData.subtotal);
            const tax = parseFloat(cartData.tax_total);
            const discount = parseFloat(cartData.discount_total || 0);
            
            const newTotal = subtotal + tax + shippingRate - discount;
            
            // Update UI
            document.getElementById('shipping-cost-display').textContent = shippingRate === 0 ? 'FREE' : `₹${shippingRate.toFixed(2)}`;
            document.getElementById('grand-total-display').textContent = `₹${newTotal.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
            document.getElementById('orderBtnText').textContent = `Place Order & Pay ₹${newTotal.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
            
            // Sync with hidden input if needed
            let shipInput = document.getElementById('shipping_cost_hidden');
            if (!shipInput) {
                shipInput = document.createElement('input');
                shipInput.type = 'hidden';
                shipInput.name = 'shipping_cost';
                shipInput.id = 'shipping_cost_hidden';
                checkoutForm.appendChild(shipInput);
            }
            shipInput.value = shippingRate;
        }

        // --- Payment Logic (Razorpay) ---
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', async function(e) {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
                
                if (paymentMethod === 'cod') return true; // Let browser submit COD
                
                e.preventDefault();
                const btn = document.getElementById('placeOrderBtn');
                const originalContent = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Initializing Secure Payment...';

                try {
                    const formData = new FormData(checkoutForm);
                    const response = await fetch("{{ route('customer.checkout.razorpay.order') }}", {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
                    });

                    const data = await response.json();
                    
                    if (!data.success) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Error',
                            text: data.message || 'Failed to initialize payment.',
                            confirmButtonColor: '#1c1917'
                        });
                        btn.disabled = false;
                        btn.innerHTML = originalContent;
                        return;
                    }

                    const options = {
                        key: data.key_id,
                        amount: data.amount,
                        currency: "INR",
                        name: "{{ config('app.name') }}",
                        description: "Premium Wellness Products",
                        order_id: data.order_id,
                        handler: function(response) {
                            submitFinalPayment(response);
                        },
                        prefill: {
                            name: formData.get('full_name'),
                            email: formData.get('email'),
                            contact: formData.get('phone')
                        },
                        theme: { color: "#1c1917" },
                        modal: {
                            ondismiss: function() {
                                // User closed modal without completing payment
                                btn.disabled = false;
                                btn.innerHTML = originalContent;
                            }
                        }
                    };

                    const rzp = new Razorpay(options);
                    
                    // Handle payment failure
                    rzp.on('payment.failed', function (response){
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Failed',
                            text: response.error.description,
                            confirmButtonColor: '#1c1917'
                        });
                        btn.disabled = false;
                        btn.innerHTML = originalContent;
                    });
                    
                    rzp.open();
                    
                } catch (error) {
                    console.error('Payment initialization error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.',
                        confirmButtonColor: '#1c1917'
                    });
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                }
            });
        }

        function submitFinalPayment(razorResponse) {
            const finalForm = document.createElement('form');
            finalForm.method = 'POST';
            finalForm.action = "{{ route('customer.checkout.payment.callback') }}";
            finalForm.innerHTML = `
                @csrf
                <input type="hidden" name="razorpay_payment_id" value="${razorResponse.razorpay_payment_id}">
                <input type="hidden" name="razorpay_order_id" value="${razorResponse.razorpay_order_id}">
                <input type="hidden" name="razorpay_signature" value="${razorResponse.razorpay_signature}">
            `;
            document.body.appendChild(finalForm);
            finalForm.submit();
        }
    });

    // --- Helper Styles ---
    (function() {
        const style = document.createElement('style');
        style.textContent = `
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: #f5f5f4; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #d6d3d1; border-radius: 10px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #a8a29e; }
        `;
        document.head.appendChild(style);
    })();
</script>
@endpush
