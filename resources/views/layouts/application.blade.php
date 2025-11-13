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
    <div class="flex min-h-screen">
        {{-- Navigation --}}
        @include('partials.navigation')

        {{-- Contenu de la page --}}
        <main >
            @yield('content')
        </main>
    </div>
    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>
