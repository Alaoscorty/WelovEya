<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeLovEya - Festival Musical</title>
    <!-- Tailwind, Font Awesome, etc. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo-WLE_Plan-de-travail-1.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
                
            </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="checkout-btn" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                        Passer la commande
                    </button>
                    <script>
                        document.getElementById('checkout-btn').addEventListener('click', function() {
                            // Récupère le nombre de commandes dans le localStorage ou 0
                            let ordersCount = parseInt(localStorage.getItem('ordersCount') || '0', 10);
                            ordersCount += 1;
                            localStorage.setItem('ordersCount', ordersCount);
                        });
                    </script>
                    <!-- Modal Paiement -->
                    <div id="payment-modal" class="fixed inset-0 z-60 hidden overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <div class="fixed inset-0 bg-gray-900 opacity-60"></div>
                            <div class="bg-white rounded-lg shadow-lg max-w-md w-full z-10 p-8 relative">
                                <button id="close-payment-modal" class="absolute top-3 right-3 text-gray-400 hover:text-orange-500 text-xl">
                                    <i class="fas fa-times"></i>
                                </button>
                                <h3 class="text-2xl font-bold text-center mb-4 text-orange-500">Paiement de la commande</h3>
                                <form id="payment-form" class="space-y-5">
                                    <div>
                                        <label class="block text-gray-500 font-medium mb-1">Méthode de paiement</label>
                                        <select id="payment-method" required class="w-full px-4 py-2 border text-gray-800 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                                            <option value="">Sélectionnez une méthode</option>
                                            <option value="mobile">Mobile Money (MTN, Moov, etc.)</option>
                                            <option value="bank">Virement bancaire (Bénin)</option>
                                        </select>
                                    </div>
                                    <div id="mobile-info-pay" class="hidden text-gray-500">
                                        <p class="text-sm text-gray-600 mt-2">
                                            Payez via MTN Mobile Money au <span class="font-bold text-orange-500">+229 51563219</span> ou Moov au <span class="font-bold text-orange-500">+229 94516481</span> puis entrez le numéro de transaction ci-dessous.
                                        </p>
                                        <input type="text" id="mobile-transaction-pay" placeholder="Numéro de transaction" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    </div>
                                    <div id="bank-info-pay" class="hidden">
                                        <p class="text-sm text-gray-600 mt-2">
                                            Faites un virement à la banque :<br>
                                            <span class="font-bold">Banque : Ecobank Bénin</span><br>
                                            <span class="font-bold">IBAN : BJ6600100100000000123456789</span><br>
                                            <span class="font-bold">Nom : WeLovEya </span>
                                        </p>
                                        <input type="text" id="bank-reference-pay" placeholder="Référence du virement" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    </div>
                                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded transition duration-300">Confirmer le paiement</button>
                                    <div id="payment-success" class="hidden text-green-600 text-center font-medium mt-4">Paiement confirmé ! Génération du PDF...</div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                    document.getElementById('checkout-btn').onclick = function() {
                        document.getElementById('payment-modal').classList.remove('hidden');
                    };
                    document.getElementById('close-payment-modal').onclick = function() {
                        document.getElementById('payment-modal').classList.add('hidden');
                    };
                    document.getElementById('payment-method').addEventListener('change', function() {
                        document.getElementById('mobile-info-pay').classList.toggle('hidden', this.value !== 'mobile');
                        document.getElementById('bank-info-pay').classList.toggle('hidden', this.value !== 'bank');
                    });
                    document.getElementById('payment-form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        document.getElementById('payment-success').classList.remove('hidden');
                        setTimeout(() => {
                            // Génération du PDF de commande
                            const { jsPDF } = window.jspdf;
                            const doc = new jsPDF();
                            doc.setFontSize(16);
                            doc.text("WeLovEya - Réçu de votre commande", 10, 15);
                            doc.setFontSize(12);
                            let y = 30;
                            doc.text("Produits :", 10, y);
                            y += 8;
                            let total = 0;
                            cart.forEach(item => {
                                doc.text(`${item.name} x${item.quantity} - FCFA ${(item.price * item.quantity).toFixed(2)}`, 12, y);
                                y += 7;
                                total += item.price * item.quantity;
                            });
                            y += 5;
                            doc.text(`Total : FCFA ${total.toFixed(2)}`, 10, y);
                            y += 10;
                            doc.text("Merci pour votre commande !", 10, y);

                            // Génère le PDF en blob
                            doc.save("votrecommande.pdf");

                            // Prépare le message WhatsApp
                            const phone = "22994516481";
                            const text = encodeURIComponent("Bonjour, j'ai effectué mon paiement. Veuillez trouver ci-joint le PDF de ma commande.");
                            // Ouvre WhatsApp (l'utilisateur doit joindre le PDF manuellement)
                            window.open(`https://wa.me/${phone}?text=${text}`, '_blank');

                            document.getElementById('payment-modal').classList.add('hidden');
                            document.getElementById('payment-success').classList.add('hidden');
                            document.getElementById('payment-form').reset();
                            document.getElementById('mobile-info-pay').classList.add('hidden');
                            document.getElementById('bank-info-pay').classList.add('hidden');
                        }, 1200);
                    });
        
                    </script>
                    <a href="{{ url('/produit') }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                        Continuer mes achats
                    </a>
                </div>
    </div>
    
    <!-- Overlay for cart sidebar -->
    <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>
