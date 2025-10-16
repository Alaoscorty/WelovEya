@extends('layouts.app')

@section('title', 'Artistes')

@section('content')
    <!-- section carousel -->
        <div class="relative h-screen w-full overflow-hidden">
        <!-- Slides -->
        <div class="relative h-full w-full">
            <!-- Slide 1 -->
            <div class="slide absolute inset-0 w-full h-full active-slide">
                <div class="absolute inset-0 overlay"></div>
                <img src="{{ asset('images/WLE-24_SITE-WEB_SAVE-THE-DATE-1') }}" alt="Personne en costume futuriste" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16 lg:px-24 xl:px-32">
                    <div class="max-w-2xl">
                        <h2 class="text-yellow-400 text-2xl md:text-3xl lg:text-4xl font-bold mb-4 animate-fadeIn">WeLovEya ne sera pas comme...</h2>
                        <p class="text-white text-xl md:text-2xl mb-8">Découvrez l'avenir de la festivité</p>
                        <div class="flex justify-center space-x-20">
                            <button class=" bg-red-900 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                                    Acheter votre ticket      
                            </button>
                            <button class=" bg-yellow-600 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                                <i class="fas fa-play"></i>    Voir la bande d'annonce
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 w-full h-full inactive-slide">
                <div class="absolute inset-0 overlay"></div>
                <img src="{{ asset('images/WLE_REV-Nikanor.png') }}" alt="Artistes" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16 lg:px-24 xl:px-32">
                    <div class="max-w-2xl">
                        <h2 class="text-yellow-400 text-2xl md:text-3xl lg:text-4xl font-bold mb-4">Spéciale ? Mieux, vous êtes unique.</h2>
                        <p class="text-white text-xl md:text-2xl mb-8">Personnalisez votre expérience en festivité</p>
                        <div class="flex justify-center space-x-20">
                            <button class=" bg-red-900 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                                    Acheter votre ticket      
                            </button>
                            <button class=" bg-yellow-600 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                                <i class="fas fa-play"></i>    Voir la bande d'annonce
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide absolute inset-0 w-full h-full inactive-slide">
                <div class="absolute inset-0 overlay"></div>
                <img src="{{ asset('images/Black-women.jpeg') }}" alt="Réseau" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16 lg:px-24 xl:px-32">
                    <div class="max-w-2xl">
                        <h2 class="text-yellow-400 text-2xl md:text-3xl lg:text-4xl font-bold mb-4">Connectivité nouvelle génération</h2>
                        <p class="text-white text-xl md:text-2xl mb-8">Latence ultra-faible, vitesse révolutionnaire avec l'intégration de notre chat en ligne , vibrons ensemble</p>
                        <div class="flex justify-center space-x-20">
                            <button class=" bg-red-900 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                                    Acheter votre ticket      
                            </button>
                            <button class=" bg-yellow-600 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                                <i class="fas fa-play"></i>    Voir la bande d'annonce
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation dots -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-3 z-20">
            <button class="dot w-3 h-3 rounded-full bg-gray-600 active" data-slide="0"></button>
            <button class="dot w-3 h-3 rounded-full bg-gray-600" data-slide="1"></button>
            <button class="dot w-3 h-3 rounded-full bg-gray-600" data-slide="2"></button>
        </div>

        <!-- Chat button -->
        <button class="absolute bottom-8 right-8 bg-blue-600 text-white p-4 rounded-full shadow-lg chat-bubble z-20">
            <i data-feather="message-circle"></i>
        </button>
        <!-- Navigation arrows -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full z-20 hover:bg-opacity-70 transition" id="prev-slide">
            <i data-feather="chevron-left"></i>
        </button>
        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full z-20 hover:bg-opacity-70 transition" id="next-slide">
            <i data-feather="chevron-right"></i>
        </button>
    </div>
    <!-- Fin de la section carousel  -->

    <p class="mt-5 mb-5 text-center text-gray-300 text-lg">
        Plus que quelques moments avant le festival
    </p>
    <!-- Stats Section -->
    <div class="mt-16 flex justify-center mb-16">
        <div class="grid grid-cols-4 gap-4">
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl text-blue-800 font-bold" id="days">90</div>
                <div class="text-gray-400 text-sm">Jours</div>
            </div>
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl font-bold text-blue-800" id="hours">05</div>
                <div class="text-gray-400 text-sm">Heures</div>
            </div>
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl font-bold text-blue-800" id="minutes">24</div>
                <div class="text-gray-400 text-sm">Minutes</div>
            </div>
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl font-bold text-blue-800" id="seconds">54</div>
                <div class="text-gray-400 text-sm">Secondes</div>
            </div>
        </div>
    </div>
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">WeLovEya en chiffres</h1>
        <p class="mt-5 mb-5 text-center text-gray-300 text-lg">
            l'ampleur de cet évènement exceptionnel
        </p>
        <div class="mt-16 flex justify-center mb-16">
            <div class="grid grid-cols-3 gap-3">
                <div class="border border-b-5 border-gray-500 rounded-lg py-4 px-6 text-center items-center ">
                    <div style=" background:rgba(255, 255, 255, 0.06); width:8vh; height:8vh; border-radius:100%; padding:8px; margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-user-friends" style="color:red;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold">+70k</div>
                    <div class="text-gray-400 text-sm">Festivaires</div>
                </div>
                <div class="border border-b-5 border-gray-500 rounded-lg py-4 px-6 text-center items-center ">
                    <div style=" background:rgba(255, 255, 255, 0.06); width:8vh; height:8vh; border-radius:100%; padding:8px;margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-music" style="color:yellow;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold">+30</div>
                    <div class="text-gray-400 text-sm">Artistes</div>
                </div>
                <div class="border border-b-5 border-gray-500 rounded-lg py-4 px-6 text-center items-center ">
                    <div style=" background:rgba(255, 255, 255, 0.06); width:8vh; height:8vh; border-radius:100%; padding:8px;margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-clipboard" style="color:green;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold ">+20</div>
                    <div class="text-gray-400 text-sm">Partenaires officiels</div>
                </div>
            </div>
        </div>
        <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Annonces officielle</h1>
        <p class="mt-5 mb-5 text-center text-gray-300 text-lg">
            Marquez vos calendriers! l'évènement musical le plus attendu du Bénin revient.
        </p>
        <!-- insertion d'image -->
         <div class="flex justify-center">
            <img src="{{ asset('images/WLE-25_SAVE-THE-DATE_INSTA.png') }}" alt="Logo" width="200">
        </div>
         <p class=" font-bold mt-2 mb-2 ">WeLovEya2025: Une expérience inédite vous attend</p>
        <p class="mt-2 mb-2 text-center text-gray-300 text-lg">
            Préparez-vous à vivre deux jours exeptionnels les <span class="text-orange-800">27 et 28 décembre 2025.</span> Cette nouvelle édition de WeLovEya promet d'être la plus spectaculaire avec des artistes internationaux, des expériences en 3D révolutionnaires, et une productiuon jamais vue au Bénin. <br>
            Ne manquez pas cette occasion unique de faire partie de l'histoire musicale béninoise. Les billets serobt bientôt disponibles - restez connêctés pour être les premiers informés !
        </p>
        <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Découvez WeLovEya </h1>
        <p class="mt-2 mb-2 text-center text-gray-300 text-lg">
            Une expérience musicale complète avec des fonctionalités innovantes pour vivre l'évènement comme jamais auparavant.
        </p>
    </div>
    <div class="mt-6 mb-16 mx-4 flex flex-col lg:flex-row">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        <!-- Carte 1 -->
        <div class="border border-gray-500 rounded-lg py-4 px-6 flex flex-col items-center text-center">
            <div class="bg-red-500/30 w-20 h-20 flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-cube text-red-600 text-3xl"></i>
            </div>
            <div class="text-2xl md:text-3xl font-bold mb-3">Nos artistes</div>
            <p class="text-gray-400 text-sm mb-4">
                Découvrez vos artistes favoris grâce à des outils 3D interactifs. Explorez leurs biographies et discographies
            </p>
            <button class="border border-gray-500 rounded-lg py-2 px-4 text-gray-400 text-sm hover:bg-gray-700 transition">Découvrir</button>
        </div>

        <!-- Carte 2 -->
        <div class="border border-gray-500 rounded-lg py-4 px-6 flex flex-col items-center text-center">
            <div class="w-20 h-20 flex items-center justify-center rounded-full bg-gray-300/20 mb-4">
                <i class="fas fa-video text-3xl"></i>
            </div>
            <div class="text-2xl md:text-3xl font-bold mb-3">Live Streaming</div>
            <p class="text-gray-400 text-sm mb-4">
                Accéder au streaming en direct de l'évènement avec nos pass exclusifs. Ne ratez aucun moment !
            </p>
            <button class="border border-gray-500 rounded-lg py-2 px-4 text-gray-400 text-sm hover:bg-gray-700 transition">Découvrir</button>
        </div>

        <!-- Carte 3 -->
        <div class="border border-gray-500 rounded-lg py-4 px-6 flex flex-col items-center text-center">
            <div class="bg-yellow-400/30 w-20 h-20 flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-gamepad text-yellow-400 text-3xl"></i>
            </div>
            <div class="text-2xl md:text-3xl font-bold mb-3">Jeux & Concours</div>
            <p class="text-gray-400 text-sm mb-4">
                Participez à nos mini-jeux interactifs et tentez de gagnez des billets gratuits et des rencontres avec les artistes.
            </p>
            <button class="border border-gray-500 rounded-lg py-2 px-4 text-gray-400 text-sm hover:bg-gray-700 transition">Découvrir</button>
        </div>

        <!-- Carte 4 -->
        <div class="border border-gray-500 rounded-lg py-4 px-6 flex flex-col items-center text-center">
            <div class="bg-red-500/30 w-20 h-20 flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-laptop text-red-600 text-3xl"></i>
            </div>
            <div class="text-2xl md:text-3xl font-bold mb-3">Votez pour vos artistes</div>
            <p class="text-gray-400 text-sm mb-4">
                Influencez l'ordre des performances en votant pour vos artistes préférés. Votre voix compte !
            </p>
            <button class="border border-gray-500 rounded-lg py-2 px-4 text-gray-400 text-sm hover:bg-gray-700 transition">Découvrir</button>
        </div>

        <!-- Carte 5 -->
        <div class="border border-gray-500 rounded-lg py-4 px-6 flex flex-col items-center text-center">
            <div class="w-20 h-20 flex items-center justify-center rounded-full bg-gray-300/20 mb-4">
                <i class="fas fa-shopping-bag text-white text-3xl"></i>
            </div>
            <div class="text-2xl md:text-3xl font-bold mb-3">Boutique Officielle</div>
            <p class="text-gray-400 text-sm mb-4">
                Découvrez notre collection exclusive de produits dérivés et d'archives numériques des éditions passées.
            </p>
            <button class="border border-gray-500 rounded-lg py-2 px-4 text-gray-400 text-sm hover:bg-gray-700 transition">Découvrir</button>
        </div>

        <!-- Carte 6 -->
        <div class="border border-gray-500 rounded-lg py-4 px-6 flex flex-col items-center text-center">
            <div class="bg-yellow-400/30 w-20 h-20 flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-car text-yellow-400 text-3xl"></i>
            </div>
            <div class="text-2xl md:text-3xl font-bold mb-3 capitalize">Location de véhicules</div>
            <p class="text-gray-400 text-sm mb-4">
                Réservez votre véhicule pour vous rendre à l'évènement en toute simplicité. Service de location partenaire.
            </p>
            <button class="border border-gray-500 rounded-lg py-2 px-4 text-gray-400 text-sm hover:bg-gray-700 transition">Découvrir</button>
        </div>
    </div>
</div>

<!-- Partenaires -->
<div class="container mx-auto px-4 text-center">
    <h1 class="text-3xl md:text-5xl font-bold mt-10 mb-6 text-orange-500">Nos Partenaires</h1>
    <p class="mb-6 text-gray-300 text-lg">Ils font confiance à WeLovEya et contribuent au succès de l'évènement.</p>
    
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="border border-gray-500 rounded-lg py-4 px-6">
            <div class="text-gray-400 text-sm">Partenaire 1</div>
        </div>
        <div class="border border-gray-500 rounded-lg py-4 px-6">
            <div class="text-gray-400 text-sm">Partenaire 2</div>
        </div>
        <div class="border border-gray-500 rounded-lg py-4 px-6">
            <div class="text-gray-400 text-sm">Partenaire 3</div>
        </div>
        <div class="border border-gray-500 rounded-lg py-4 px-6">
            <div class="text-gray-400 text-sm">Partenaire 4</div>
        </div>
    </div>

    <p class="mt-4 text-gray-300 text-lg">
        Vous souhaitez devenir partenaire ? <a href="#" class="text-orange-600 underline">Contactez-nous</a>
    </p>
</div>

        

    <footer class="bg-black py-12 px-6 border-t border-gray-800 mt-20">
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
