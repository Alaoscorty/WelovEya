@extends('layouts.app')

@section('title', 'Artistes')

@section('content')

    <!-- Hero Section -->
    <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Découvrez nos produits</h1>
            <p class="text-gray-300 max-w-3xl mx-auto text-lg mb-10">
                Découvrez nos produits et nos articles sur le festival
            </p>
            
            <!-- Countdown -->
            <div class="mt-16 flex justify-center">
                <input type="text" placeholder="Rechercher un produit" class="w-full max-w-md p-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <i class="fa fa-search" data-feather="search" style="margin-left: -4vh; margin-top: 2vh; font-size: 3vh;"></i>
            </div>
        </div>
    </section>

    <!-- Discover Section -->
    <section class="py-3 px-6">
        <div class="container mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card rounded-xl p-6 hover-scale" style="background: url(images/T-shirt.jpeg);height:50vh;" data-genre="">
                    <button class=" add-to-cart mt-4  bg-orange-800 text-white font-bold py-2  w-80 px-4  rounded-lg hover:bg-orange-600 transition" style="margin-top: 37vh; "data-id="1" data-name="produit" data-price="15000" data-image="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                    <i class="fas fa-plus mr-1"></i>
                        Ajouter au panier
                    </button>
                    
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/OIP.jpeg);height:50vh;" data-genre="">
                    <button class=" add-to-cart mt-4  bg-orange-800 text-white font-bold py-2 w-80  px-4 rounded-lg  hover:bg-orange-600 transition" style="margin-top: 37vh;"data-id="2" data-name="produit" data-price="15000" data-image="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                    <i class="fas fa-plus mr-1"></i>
                        Ajouter au panier
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/0d64049a-575f-4470-9c95-46f54e3e61bb.jpeg);height:50vh;" data-genre="">
                    <button class=" add-to-cart mt-4 bg-orange-800  text-white font-bold py-2  w-80 px-4  rounded-lg hover:bg-orange-600 transition"  style="margin-top: 37vh;"data-id="3" data-name="produit" data-price="15000" data-image="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                    <i class="fas fa-plus mr-1"></i>
                        Ajouter au panier
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/Juneteenth.jpeg);height:50vh;" data-genre="">
                    <button class=" add-to-cart mt-4 bg-orange-800 text-white font-bold py-2 w-80  px-4 rounded-lg  hover:bg-orange-600 transition"  style="margin-top: 37vh;"data-id="4" data-name="produit" data-price="15000" data-image="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                    <i class="fas fa-plus mr-1"></i>
                        Ajouter au panier
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" data-genre="">
                    <button class=" add-to-cart mt-4 bg-orange-800  text-white font-bold py-2 w-80  px-4 rounded-lg  hover:bg-orange-600 transition"  style="margin-top: 37vh;"data-id="5" data-name="produit" data-price="15000" data-image="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                    <i class="fas fa-plus mr-1"></i>
                        Ajouter au panier
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/Juneteenth.jpeg); height:50vh;" data-genre="">
                    <button class=" add-to-cart mt-4 bg-orange-800 text-white font-bold py-2 w-80  px-4 rounded-lg  hover:bg-orange-600 transition"  style="margin-top: 37vh;"data-id="6" data-name="produit" data-price="15000" data-image="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                    <i class="fas fa-plus mr-1"></i>
                        Ajouter au panier
                    </button>
                </div>
            </div>
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
