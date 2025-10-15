<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeLovEya - @yield('title', 'Festival Musical')</title>
    <!-- Tailwind, Font Awesome, etc. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo-WLE_Plan-de-travail-1.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="min-h-screen bg-black text-white">

    {{-- Navigation --}}
    @include('partials.nav')

    {{-- Contenu de la page --}}
    <main>
        @yield('content')
    </main>

    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>
