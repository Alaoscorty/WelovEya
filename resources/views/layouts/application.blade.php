<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WELOVEYA - Tableau de bord</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body class="bg-[#0a0d1f] text-white min-h-screen bg-gradient-to-br from-slate-950 via-blue-950 to-slate-950">
    <!-- Mobile Menu Toggle -->
    <button id="mobileMenuToggle" class="lg:hidden fixed top-4 left-4 z-50 bg-[#ff6b35] text-white p-2 rounded-md shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <div class="flex min-h-screen">
        {{-- Navigation --}}
        <div id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-[#0f1229] transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            @include('partials.navigation')
        </div>

        <!-- Overlay for mobile -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

        {{-- Contenu de la page --}}
        <main class="flex-1 lg:ml-0 ml-0 overflow-hidden">
            @yield('content')
        </main>
    </div>
    {{-- Scripts --}}
    @stack('scripts')
    <script>
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    </script>
</body>
</html>
