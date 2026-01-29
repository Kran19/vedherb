@extends('customer.layouts.master')

@section('title', 'My Addresses')

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6">
        <nav class="flex text-sm text-stone-500 mb-6 sm:mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                        <iconify-icon icon="lucide:home" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm">Home</span>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <a href="{{ route('customer.account.profile') }}" class="ml-1 sm:ml-2 text-xs sm:text-sm hover:text-emerald-700">My Account</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm text-stone-900 font-medium">My Addresses</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Left Sidebar - Account Navigation -->
            @include('customer.account.partials.sidebar')

            <!-- Right Content Area -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 mb-6 sm:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
                        <h2 class="text-lg sm:text-xl font-semibold text-stone-900">My Addresses ({{ $addresses->count() }})</h2>
                        <button onclick="openAddAddressModal()"
                            class="inline-flex items-center gap-2 bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-800 transition-colors shadow-sm">
                            <iconify-icon icon="lucide:plus" width="16"></iconify-icon>
                            Add New Address
                        </button>
                    </div>

                    @if($addresses->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        @foreach($addresses as $address)
                        <div class="relative border {{ $address->is_default ? 'border-emerald-500 bg-emerald-50/30' : 'border-stone-200 bg-stone-50/10' }} rounded-xl p-4 sm:p-6 transition-all hover:border-emerald-300">
                            @if($address->is_default)
                            <div class="absolute top-4 right-4">
                                <span class="bg-emerald-600 text-white text-[10px] sm:text-xs px-2 sm:px-3 py-1 rounded-full font-medium">Default</span>
                            </div>
                            @endif

                            <div class="mb-4">
                                <h3 class="font-bold text-stone-900 text-base sm:text-lg mb-1">{{ $address->name }}</h3>
                                <div class="flex items-center gap-2 text-xs sm:text-sm text-stone-500">
                                    @switch($address->type)
                                        @case('shipping')
                                            <iconify-icon icon="lucide:truck" width="14"></iconify-icon>
                                            <span>Shipping Address</span>
                                            @break
                                        @case('billing')
                                            <iconify-icon icon="lucide:file-text" width="14"></iconify-icon>
                                            <span>Billing Address</span>
                                            @break
                                        @case('both')
                                            <iconify-icon icon="lucide:shield-check" width="14"></iconify-icon>
                                            <span>Shipping & Billing</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>

                            <div class="space-y-1 text-xs sm:text-sm text-stone-600 leading-relaxed">
                                <p>{{ $address->address }}</p>
                                <p>{{ $address->city }}, {{ $address->state }} {{ $address->pincode }}</p>
                                <p>{{ $address->country }}</p>
                                <div class="pt-2 flex items-center gap-2 text-stone-900 font-medium">
                                    <iconify-icon icon="lucide:phone" width="14"></iconify-icon>
                                    <span>{{ $address->mobile }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-6 pt-6 border-t border-stone-200/60">
                                <button onclick="editAddress({{ $address->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-50 rounded-md transition-colors">
                                    <iconify-icon icon="lucide:edit-2" width="14"></iconify-icon>
                                    Edit
                                </button>

                                @if(!$address->is_default)
                                <form method="POST" action="{{ route('customer.account.addresses.set-default', $address->id) }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-stone-600 hover:bg-stone-100 rounded-md transition-colors">
                                        <iconify-icon icon="lucide:star" width="14"></iconify-icon>
                                        Set Default
                                    </button>
                                </form>
                                @endif

                                <form method="POST" action="{{ route('customer.account.addresses.delete', $address->id) }}" class="inline ml-auto" id="deleteForm{{ $address->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $address->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                        <iconify-icon icon="lucide:trash-2" width="14"></iconify-icon>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-stone-500">
                            <iconify-icon icon="lucide:map-pin" width="48" class="mb-2 opacity-20"></iconify-icon>
                            <h3 class="text-lg font-semibold text-stone-900 mb-1">No Addresses Saved</h3>
                            <p class="text-stone-600 mb-6">Add your first address to get started with faster checkouts.</p>
                            <button onclick="openAddAddressModal()"
                                class="inline-flex items-center gap-2 bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-emerald-800 transition-all hover:-translate-y-0.5">
                                <iconify-icon icon="lucide:plus" width="20"></iconify-icon>
                                Add Your First Address
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Address Modal -->
    <div id="addressModal" class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm hidden z-[60] p-4">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all">
            <div class="p-6 sm:p-8">
                <div class="flex justify-between items-center mb-6 sm:mb-8">
                    <h3 class="text-xl sm:text-2xl font-bold text-stone-900" id="modalTitle">Add New Address</h3>
                    <button onclick="closeAddressModal()" class="text-stone-400 hover:text-stone-600 transition-colors">
                        <iconify-icon icon="lucide:x" width="24"></iconify-icon>
                    </button>
                </div>

                <form id="addressForm" method="POST" action="{{ route('customer.account.addresses.store') }}" class="space-y-4 sm:space-y-6">
                    @csrf
                    <div id="methodSpoof"></div>
                    <input type="hidden" id="addressId" name="id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Full Name *</label>
                            <input type="text" id="fullName" name="name" required
                                class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Address Type</label>
                            <select id="addressType" name="type"
                                class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base bg-white">
                                <option value="shipping">Shipping</option>
                                <option value="billing">Billing</option>
                                <option value="both">Shipping & Billing</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Mobile Number *</label>
                        <input type="text" id="mobile" name="mobile" required
                            class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Full Address *</label>
                        <textarea id="addressLine1" name="address" required rows="3"
                            class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">City *</label>
                            <input type="text" id="city" name="city" required
                                class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">State *</label>
                            <input type="text" id="state" name="state" required
                                class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Pincode *</label>
                            <input type="text" id="pincode" name="pincode" required
                                class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Country *</label>
                            <select id="country" name="country" required
                                class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base bg-white">
                                <option value="IN" selected>India</option>
                                <option value="US">United States</option>
                                <option value="GB">United Kingdom</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                            </select>
                        </div>

                        <div class="flex items-end pb-3 sm:pb-4">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" id="setAsDefault" name="is_default" value="1" class="sr-only peer">
                                    <div class="w-10 h-6 bg-stone-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                </div>
                                <span class="text-sm font-medium text-stone-600 group-hover:text-stone-900 transition-colors">Set as default</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 mt-6 border-t border-stone-100">
                        <button type="button" onclick="closeAddressModal()"
                            class="px-6 py-3 border border-stone-200 text-stone-600 rounded-xl hover:bg-stone-50 transition-colors text-sm font-semibold flex-1 sm:flex-none">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-8 py-3 bg-emerald-700 text-white rounded-xl hover:bg-emerald-800 transition-all text-sm font-semibold flex-1 shadow-lg shadow-emerald-500/20">
                            Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function openAddAddressModal() {
    document.getElementById('modalTitle').textContent = 'Add New Address';
    document.getElementById('addressForm').action = "{{ route('customer.account.addresses.store') }}";
    document.getElementById('addressForm').reset();
    document.getElementById('addressId').value = '';
    document.getElementById('methodSpoof').innerHTML = '';
    
    const modal = document.getElementById('addressModal');
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function editAddress(addressId) {
    // Show loading state or at least open modal
    document.getElementById('modalTitle').textContent = 'Loading...';
    const modal = document.getElementById('addressModal');
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    fetch("{{ route('customer.account.addresses.get', ':id') }}".replace(':id', addressId))
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = 'Edit Address';
            document.getElementById('addressForm').action = "/account/addresses/" + addressId;

            // Add method spoofing for PUT request
            document.getElementById('methodSpoof').innerHTML = '<input type="hidden" name="_method" value="PUT">';

            // Fill form with address data
            document.getElementById('addressId').value = data.id;
            document.getElementById('fullName').value = data.name;
            document.getElementById('mobile').value = data.mobile;
            document.getElementById('addressLine1').value = data.address;
            document.getElementById('city').value = data.city;
            document.getElementById('state').value = data.state;
            document.getElementById('pincode').value = data.pincode;
            document.getElementById('country').value = data.country;
            document.getElementById('addressType').value = data.type;
            document.getElementById('setAsDefault').checked = data.is_default == 1;
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Failed to load address data', 'error');
            closeAddressModal();
        });
}

function closeAddressModal() {
    const modal = document.getElementById('addressModal');
    modal.style.display = 'none';
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function confirmDelete(addressId) {
    Swal.fire({
        title: 'Delete Address?',
        text: 'Are you sure you want to delete this address? This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + addressId).submit();
        }
    });
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('addressModal');
    if (event.target == modal) {
        closeAddressModal();
    }
}
</script>
@endsection
