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
     <!-- Shopping Cart Sidebar -->
    <div id="cart-sidebar" class="fixed top-0 right-0 h-full w-full md:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Votre Panier</h3>
                <button id="close-cart" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div id="cart-items" class="mb-6 space-y-4">
                <!-- Carte produit dynamique -->
                <div class="text-center py-8 text-gray-500" id="empty-cart-message">
                    <i class="fas fa-shopping-bag text-4xl mb-2"></i>
                    <p>Votre panier est vide</p>
                </div>
            </div>
            
            <div id="cart-summary" class="border-t border-gray-200 text-gray-600 pt-4 hidden">
                <div class="flex justify-between mb-2">
                    <span>Sous-total</span>
                    <span id="cart-subtotal">0FCFA</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Livraison</span>
                    <span>Calculé à l'étape suivante</span>
                </div>
                <div class="flex justify-between font-bold text-lg mt-4">
                    <span>Total</span>
                    <span id="cart-total">0FCFA</span>
                </div>
                
                <div class="mt-6 space-y-3">
                    <a href="#" class="block bg-orange-600 hover:bg-orange-700 text-white text-center py-3 rounded-full font-medium transition">Passer la commande</a>
                    <a href="#" class="block border border-orange-600 text-orange-600 hover:bg-orange-50 text-center py-3 rounded-full font-medium transition">Continuer mes achats</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Overlay for cart sidebar -->
    <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>
