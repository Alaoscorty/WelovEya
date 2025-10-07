@extends('layouts.app')

@section('title', 'Artistes')

@section('content')
    <!--Première section -->
    <div class=" justify-center " style="background:url(images/WLE-25_SAVE-THE-DATE_INSTA.png); height:80vh; background-size: cover; background-position: center;padding-top: 45vh;">
        <P class="text-white text-xl font-bold mt-6 mb-6" style="background-color: rgba(0, 0, 0, 0.7); padding: 10px; padding-left: 20px; padding-right: 20px">
            L'évènement musical le plus attendu de l'année arrive !
            <br>
            Découvrez vos artistes préférés, participez aux jeux et vivez l'expérienec en direct
        </P>
        <div class="flex justify-center space-x-20">
            <button class=" bg-red-900 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                    Acheter votre ticket      
            </button>
            <button class=" bg-yellow-600 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
                <i class="fas fa-play"></i>    Voir la bande d'annonce
            </button>
        </div>
        
    </div>
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
    <div class="mt-6 mb-16 m-8" >
            <div class="grid grid-cols-3 gap-3">
                <div class="border border-b border-gray-500 rounded-lg py-4 px-6 items-center">
                    <div style=" background:rgba(243, 9, 9, 0.34); width:8vh; height:8vh;; padding:8px; margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-cube" style="color:red;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold mb-5 fonts">Nos artistes</div>
                    <div class="text-gray-400 text-sm">Découvrez vos artistes favoris grâce à des outils 3D interactifs. Explorez leurs biographies et discographies</div>
                    <button class="border border-b border-gray-500 rounded-lg py-2 px-4 text-center mt-5">
                        <div class="text-gray-400 text-sm">Découvrir</div>
                    </button>
                </div>
                <div class="border border-b border-gray-500 rounded-lg py-4 px-6 items-center">
                    <div style=" width:8vh; height:8vh; ; padding:8px;margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-video" style="font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold mb-5 fonts">Live Streaming</div>
                    <div class="text-gray-400 text-sm">Accéder au streaming en direct de l'évènement avec nos pass exclusifs.
                        Ne ratez aucun moment !
                    </div>
                    <button class="border border-b border-gray-500 rounded-lg py-2 px-4 text-center mt-5">
                        <div class="text-gray-400 text-sm">Découvrir</div>
                    </button>
                </div>
                <div class="border border-b border-gray-500 rounded-lg py-4 px-6 items-center">
                    <div style=" background:rgba(247, 209, 44, 0.34); width:8vh; height:8vh; ; padding:8px;margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-gamepad" style="color:yellow;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold mb-5 fonts ">Jeux & Concours</div>
                    <div class="text-gray-400 text-sm">Participez à nos mini-jeux interactifs et tentez de gagnez des billets gratuits et des rencontres avec les artistes.</div>
                    <button class="border border-b border-gray-500 rounded-lg py-2 px-4 text-center mt-5">
                        <div class="text-gray-400 text-sm">Découvrir</div>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3 mt-5">
                <div class="border border-b border-gray-500 rounded-lg py-4 px-6 items-center">
                    <div style=" background:rgba(243, 9, 9, 0.34); width:8vh; height:8vh; ; padding:8px; margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-laptop" style="color:red;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold mb-5 fonts">Votez pour vos artistes</div>
                    <div class="text-gray-400 text-sm">Influencez l'ordre des performances en votant pour vos artistes préféres. votre voix compte!</div>
                    <button class="border border-b border-gray-500 rounded-lg py-2 px-4 text-center mt-5">
                        <div class="text-gray-400 text-sm">Découvrir</div>
                    </button>
                </div>
                <div class="border border-b border-gray-500 rounded-lg py-4 px-6 items-center">
                    <div style=" width:8vh; height:8vh; ; padding:8px;margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-shopping-bag" style="color:white;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold mb-5 fonts">Boutique Officielle</div>
                    <div class="text-gray-400 text-sm">Découvrez notre collection exclusive de produits dérivés et d'archives numériques des éditions passés</div>
                    <button class="border border-b border-gray-500 rounded-lg py-2 px-4 text-center mt-5">
                        <div class="text-gray-400 text-sm">Découvrir</div>
                    </button>
                </div>
                <div class="border border-b border-gray-500 rounded-lg py-4 px-6 items-center">
                    <div style=" background:rgba(247, 209, 44, 0.34); width:8vh; height:8vh;; padding:8px;margin-left: 5vh; margin-bottom: 5px;">
                        <i class="fas fa-car" style="color:yellow;font-size:4vh;"></i>
                    </div>
                    <div class="text-4xl font-bold mb-5 fonts "> location de véhicules</div>
                    <div class="text-gray-400 text-sm">Réservez votre véhicule pour vous rendre à l'évènement en toute simplicité Service de location partenaire</div>
                    <button class="border border-b border-gray-500 rounded-lg py-2 px-4 text-center mt-5">
                        <div class="text-gray-400 text-sm">Découvrir</div>
                    </button>
                </div>
            </div>
        </div>

        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Nos Partenaires</h1>
                <p class="mt-5 mb-5 text-center text-gray-300 text-lg">
                    Ils font confiance à WeLovEya et contribuent au succès de l'évènement.
                </p>
                <div class="grid grid-cols-4 gap-4 mt-5">
                    <div class="border border-b border-gray-500 rounded-lg py-4 px-6 text-center items-center">
                        <div class="text-gray-400 text-sm">Partenaires 1</div>
                    </div>
                    <div class="border border-b border-gray-500 rounded-lg py-4 px-6 text-center items-center">
                        <div class="text-gray-400 text-sm">Partenaires 2</div>
                    </div>
                    <div class="border border-b border-gray-500 rounded-lg py-4 px-6 text-center items-center">
                        <div class="text-gray-400 text-sm">Partenaires 3</div>
                    </div>
                    <div class="border border-b border-gray-500 rounded-lg py-4 px-6 text-center items-center">

                        <div class="text-gray-400 text-sm">Partenaires 4</div>
                    </div>
                </div>
        <p class="mt-2 mb-2 text-center text-gray-300 text-lg">
            Vous souhaitez devenir partenaires ? <a href="" class="text-orange-800">Contactez nous</a>
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
