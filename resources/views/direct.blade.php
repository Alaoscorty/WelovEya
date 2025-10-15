@extends('layouts.app')

@section('title', 'Artistes')

@section('content')

    <!-- Hero Section -->
    <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center mb-30">
            <h1 class="text-4xl md:text-6xl font-bold mt-1 mb-1 text-orange-500">WeLovEya Live :    <span class="text-orange-500 max-w-3xl mx-auto text-lg mb-10">
            Le compte à rebours est lancé </span> 
            </h1> 
        </div>
    </section>
    <!-- Stats Section -->
    <div class="mt-2 mb-10 flex justify-center ">
        <div class="grid grid-cols-4 gap-4">
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl text-blue-800 font-bold" id="days">90</div>
                <div class="text-gray-400 text-sm">Jours</div>
            </div>
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl text-blue-800 font-bold" id="hours">05</div>
                <div class="text-gray-400 text-sm">Heures</div>
            </div>
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl text-blue-800 font-bold" id="minutes">24</div>
                <div class="text-gray-400 text-sm">Minutes</div>
            </div>
            <div class="countdown-box py-4 px-6 text-center">
                <div class="text-4xl text-blue-800 font-bold" id="seconds">54</div>
                <div class="text-gray-400 text-sm">Secondes</div>
            </div>
        </div>
    </div>

    <!-- section de direct live -->
    <div class="mt-2 justify-center text-center bg-orange-800 p-6 rounded-lg" style="margin-left: 5vh; margin-right: 5vh;">
        <h1 class="text-xl  font-bold mt-1 mb-3 text-white">
            LE FESTIVAL EST A VOTRE PORTEE. VIBREZ, PEU IMPORTE OU VOUS ETES
        </h1>
        <P>
            Vivez les sets explosifs de Davido, Tayc et Asake depuis chez vous, en qualité HD exclusive.Ne manquez aucune minute de la fête, des coulisses à la scène principale.Votre pass streaming est à 50£ pour deux jours d'énergie pure. 
        </P>
        <button class=" bg-orange-500 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition">
            Acheter votre Pass Streaming
        </button>
        <br>
        <a href="" class=" text-blue-500 px-4 py-2 mt-10">
            Vous avez déjà votre pass, cliquez ici pour entrez votre code d'accès.
        </a>
    </div>
    <!-- section de fin de la direct live -->
    <div class="flex justify-center ">
        <div class="mt-5 justify-center border border-gray-800  rounded-lg" style="margin-left: 5vh; margin-right: 5vh;">
            <div class="flex justify-between items-center p-6">
                <div class="flex items-center space-x-4">
                    <div class=" font-bold mb-4 text-center text-white bg-red-800 rounded-lg py-2 px-5">
                        <i class="fas fa-circle text-green-500"></i>
                    En direct
                    </div>
                    <div class="mb-4 py-2">
                        <i class="fas fa-user-friends"></i>
                        1,234 spectacteurs
                    </div>
                </div>
                <div>
                    <i class="fas fa-share-alt"></i>
                </div>
            </div>
            <div class="bg-gray-800 p-6">
                <!-- Lecteur vidéo en direct -->
                <video id="liveVideo" controls style="width: 100%; height: 50vh; background-color: black;">
                    <source src="//https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                </video>
                <p class="text-white mt-2">
                    Festival WelovEya - Scène Principale
                </p>
                <!-- Bouton pour enregistrer la vidéo -->
                <button id="recordBtn" class="bg-red-500 text-white font-bold py-2 px-4 mt-4 rounded-lg hover:bg-red-600 transition">
                    Commencer l'enregistrement
                </button>
            </div>
        </div>
        <!-- fin de la section de fin de la direct live -->
        <!-- Section Chat (Droite) -->
        <div class="flex flex-col lg:flex-row h-screen bg-gray-900 text-white">
    <!-- Section Chat -->
    <div class="w-full lg:w-96 bg-gray-900 flex flex-col border-l border-gray-800">

        <!-- Header -->
        <div class="p-4 border-b border-gray-800 flex justify-between items-center">
            <h3 class="text-lg font-bold text-white">Chat en direct</h3>
            <div class="text-sm text-gray-400"><span id="onlineCount">0</span> en ligne</div>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chatMessages" style="max-height: 60vh;">
            <div class="text-gray-400 text-sm text-center">Chargement...</div>
        </div>

        <!-- Zone d’envoi -->
        <div class="p-4 border-t border-gray-800">
            <div class="flex space-x-2 items-center">
                <input id="messageInput" type="text" placeholder="Écrivez un message..." class="flex-1 bg-gray-800 text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
                <button id="emojiButton" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm">😊</button>
                <button id="sendButton" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Sons -->
<audio id="sendSound" src="{{ asset('sounds/send.mp3') }}"></audio>
<audio id="receiveSound" src="{{ asset('sounds/receive.mp3') }}"></audio>


    </div>
    </div>
    <!-- Footer -->
    <footer class="bg-black py-12 px-6 border-t border-gray-800 mt-8">
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
    <script src="https://cdn.jsdelivr.net/npm/emoji-picker-element@1.21.0/index.js" type="module"></script>
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
    <script src="@vite('resources/js/app.js')"></script> 
    @endpush