<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ved Herbs & Ayurveda')</title>
    
    <!-- Load Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Load Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Single Lucide import -->
    <script src="https://unpkg.com/lucide@latest" defer></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafaf9;
        }
        
        /* Custom scrollbar */
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
    </style>
    
    @stack('styles')
</head>
<body class="bg-stone-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        @yield('content')
    </div>
    
    <script>
        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>