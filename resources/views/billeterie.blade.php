@extends('layouts.app')

@section('title', 'Artistes')

@section('content')
    <!-- Hero Section -->
    <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Trouvez votre tickets et votre véhicules</h1>
            <p class="text-gray-300 max-w-3xl mx-auto text-lg mb-10">
                Réserver votre place pour une expérience inoubliables <br>
                Facilitez votre séjour: Réservez votre véhicule au meilleur prix pour le festival.
            </p>
            
            <!-- Countdown -->
            
            <div class="bg-black py-12 px-6">
                <div class="container mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-300 mb-2"><i class="far fa-calendar-minus"></i>  27-28 décembre 2025</p>
                        <p class="text-gray-300 mb-2"> <i class="fas fa-map-marker-alt"></i> Place de l'amazone</p>
                        <p class="text-gray-400 text-sm mb-2"><i class="far fa-clock"></i>  2 jours de festivités</p>
                    </div>
                </div>
            </div>  
        </div>

        <div class="mb-20 flex justify-center">
            <button class="mt-4 bg-orange-800 text-white font-bold py-4 px-4  hover:bg-orange-600 transition" style="margin-top: 2vh; margin-left: 10vh; " id="ticket-button">
                Achetez votre tickets ici   <i class="fas fa-long-arrow-alt-right"></i>
            </button>
        </div>

        <!-- section d'achat de tickets -->
        <section class="ticket-section" id="ticket-section">
            <div class="ticket-image">
                <img src="{{ asset('images/tickets') }}" alt="Ticket 2025">
            </div>
            <div class="ticket-info">
                <p class="text-2xl font-bold">Ticket 2025</p>
                <p class="price">15 000 FCFA</p>
                <p class="description">Ticket standard: Le ticket standard coûte 15000frcs et est valable pour deux jours du festival pour une personne. Il vous donne l'accès au site</p>
                
                <div class=" flex items-center">
                    <div class="quantity-control text">
                        <button class="quantity-btn minus">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="quantity-btn plus">+</button>
                    
                    </div>
                    <button class="add-to-cart bg-orange-800 text-white font-bold hover:bg-orange-600 transition"> Ajouter au panier </button>
                </div>
            </div>
        </section>
        <!-- Fin de la section  -->

        <div class="bg-gray-800 p-6 " style="background: url(images/ac0dee6a445122d535397c22d278e7e3.jpg);height:50vh;background-repeat: no-repeat;background-size: 100% auto; background-position: center"></div>

        <div class=" flex justify-center">
            <button class="mt-4 bg-orange-800 text-white font-bold py-4 px-4  hover:bg-orange-600 transition" style="margin-top: 5vh; margin-left: 10vh; ">
                Louez votre véhicule ici   <i class="fas fa-long-arrow-alt-right"></i>
            </button>
        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-black py-12 px-6 border-t border-gray-800">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 mb-2">Cotonou, Bénin</p>
                <p class="text-gray-300 mb-2">+229 XX XX XX</p>
                <p class="text-gray-400 text-sm">© 2025. Tous droits réservés</p>
            </div>
        </div>
    </footer>
    
@endsection

    @push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush