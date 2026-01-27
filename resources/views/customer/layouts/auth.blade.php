@extends('customer.layouts.minimal')

@section('content')
<div class="w-full max-w-md mx-auto">
    <!-- Logo -->
    <div class="text-center mb-8">
        <a href="{{ route('customer.home.index') }}">
            <img src="{{ asset('logo.png') }}" alt="VED HERBS & AYURVEDA" class="h-16 mx-auto mb-4">
        </a>
        <h1 class="text-2xl font-semibold text-stone-900">@yield('auth-title')</h1>
        <p class="text-stone-600 mt-2">@yield('auth-subtitle')</p>
    </div>
    
    <!-- Auth Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-8">
        @yield('auth-content')
        
        <!-- Auth Links -->
        <div class="mt-6 pt-6 border-t border-stone-200 text-center">
            @yield('auth-links')
        </div>
    </div>
</div>
@endsection