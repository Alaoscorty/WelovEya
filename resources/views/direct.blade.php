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
    <div class="mt-2 text-center bg-orange-800 p-4 sm:p-6 rounded-lg mx-4 sm:mx-10 lg:mx-20 mb-5">
        <h1 class="text-lg sm:text-xl font-bold mt-1 mb-3 text-white">
            LE FESTIVAL EST A VOTRE PORTEE. VIBREZ, PEU IMPORTE OU VOUS ETES
        </h1>
        <p class="text-white mb-4 text-sm sm:text-base">
            Vivez les sets explosifs de Davido, Tayc et Asake depuis chez vous, en qualité HD exclusive.
            Ne manquez aucune minute de la fête, des coulisses à la scène principale.
            Votre pass streaming est à 50£ pour deux jours d'énergie pure.
        </p>
        <button class="bg-orange-500 text-white font-bold py-2 px-4 mt-5 mb-5 rounded-lg hover:bg-orange-600 transition text-sm sm:text-base">
            Acheter votre Pass Streaming
        </button>
        <br>
        <a href="#" class="text-blue-500 px-4 py-2 mt-10 inline-block text-sm sm:text-base">
            Vous avez déjà votre pass, cliquez ici pour entrer votre code d'accès.
        </a>
    </div>
    <!-- fin section direct live -->

    <!-- Section vidéo et chat responsive -->
    <div class="flex flex-col lg:flex-row justify-center mx-4 sm:mx-10 lg:mx-20 mb-28">
        <!-- Section de la vidéo -->
        <div class="mt-5 border border-gray-800 rounded-lg lg:mr-10 flex-shrink-0 w-full lg:w-2/3">
            <div class="flex flex-col sm:flex-row justify-between items-center p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0">
                    <div class="font-bold text-center text-white bg-red-800 rounded-lg py-2 px-4 sm:px-5 text-sm sm:text-base">
                        <i class="fas fa-circle text-green-500"></i>
                        En direct
                    </div>
                    <div class="py-2 text-white text-sm sm:text-base">
                        <i class="fas fa-user-friends"></i>
                        1,234 spectateurs
                    </div>
                </div>
                <div class="mt-2 sm:mt-0">
                    <i class="fas fa-share-alt text-white"></i>
                </div>
            </div>
            <div class="bg-gray-800 p-4 sm:p-6">
                <!-- Lecteur vidéo en direct -->
                <div id="videoContainer">
                    <video id="liveVideo" controls class="w-full h-48 sm:h-64 md:h-96 lg:h-[64vh] bg-black rounded-md">
                        <source src="//https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                    </video>
                    <p class="text-white mt-2 text-sm sm:text-base">
                        Festival WelovEya - Scène Principale
                    </p>
                </div>
                <!-- Bouton suivre live -->
                <button id="recordBtn" class="bg-red-500 text-white font-bold py-2 px-4 mt-4 rounded-lg hover:bg-red-600 transition w-full sm:w-auto text-sm sm:text-base">
                    Suivre en live
                </button>
            </div>
        </div>

        <!-- Section Chat -->
        <div class="flex flex-col bg-gray-900 text-white border-t lg:border-t-0 lg:border-l border-gray-800 mt-5 lg:mt-0 w-full lg:w-1/3 h-[60vh] sm:h-[65vh] lg:h-auto rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="w-full lg:w-98 bg-gray-900 flex flex-col border-l border-gray-800">
                <div class="p-4 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white">Chat en direct</h3>
                    <div class="text-sm text-gray-400"><span id="onlineCount">0</span> en ligne</div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chatMessages" style="max-height: 80vh;">
                    @foreach($messages as $message)
                        <div><span class="text-blue-400 font-semibold">{{ $message->pseudo }}</span> : {{ $message->content }}</div>
                    @endforeach
                </div>

                <div class="p-4 border-t border-gray-800 mt-28">
                    <div class="flex space-x-2 items-center">
                        <input id="messageInput" type="text" placeholder="Écrivez un message..." class="flex-1 bg-gray-800 text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
                        <button id="sendButton" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm">Envoyer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sons -->
    <audio id="sendSound" src="{{ asset('sounds/send.mp3') }}"></audio>
    <audio id="receiveSound" src="{{ asset('sounds/receive.mp3') }}"></audio>

    <!-- Modal for Secret Code -->
    <div id="codeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
            <h2 class="text-xl font-bold mb-4">Entrez votre code secret</h2>
            <input type="text" id="secretCode" placeholder="Code secret" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-4">
            <div id="errorMessage" class="text-red-500 mb-4 hidden">Code incorrect. Veuillez réessayer.</div>
            <div class="flex justify-end space-x-2">
                <button id="cancelBtn" class="px-4 py-2 bg-gray-300 rounded-lg">Annuler</button>
                <button id="submitCodeBtn" class="px-4 py-2 bg-orange-500 text-white rounded-lg">Valider</button>
            </div>
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
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let pseudo = "User" + Math.floor(Math.random() * 1000);
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const sendSound = document.getElementById('sendSound');
    const receiveSound = document.getElementById('receiveSound');
    const onlineCount = document.getElementById('onlineCount');

    document.getElementById('sendButton').addEventListener('click', async () => {
        const content = messageInput.value.trim();
        if (!content) return;

        await axios.post('/send', { pseudo, content });
        sendSound.play();
        messageInput.value = '';
    });

    Echo.channel('chat')
        .listen('MessageSent', (e) => {
            const msg = document.createElement('div');
            msg.innerHTML = `<span class="text-blue-400 font-semibold border-white ">${e.message.pseudo}</span> : ${e.message.content}`;
            chatMessages.appendChild(msg);
            receiveSound.play();
        });

    // Détection du nombre d'utilisateurs connectés
    Echo.join('chat')
        .here(users => onlineCount.textContent = users.length)
        .joining(() => onlineCount.textContent++)
        .leaving(() => onlineCount.textContent--);

    // Secret Code Modal Functionality
    const recordBtn = document.getElementById('recordBtn');
    const codeModal = document.getElementById('codeModal');
    const secretCodeInput = document.getElementById('secretCode');
    const errorMessage = document.getElementById('errorMessage');
    const cancelBtn = document.getElementById('cancelBtn');
    const submitCodeBtn = document.getElementById('submitCodeBtn');
    const videoContainer = document.getElementById('videoContainer');
    const accessLink = document.querySelector('a[href=""]'); // Lien pour entrer le code secret

    const correctCode = 'WELOVEYA2024'; // Placeholder secret code

    recordBtn.addEventListener('click', () => {
        codeModal.classList.remove('hidden');
    });

    accessLink.addEventListener('click', (e) => {
        e.preventDefault();
        codeModal.classList.remove('hidden');
    });

    cancelBtn.addEventListener('click', () => {
        codeModal.classList.add('hidden');
        errorMessage.classList.add('hidden');
        secretCodeInput.value = '';
    });

    submitCodeBtn.addEventListener('click', () => {
        const code = secretCodeInput.value.trim();
        if (code === correctCode) {
            // Replace video with YouTube iframe
            videoContainer.innerHTML = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/YOUR_LIVE_VIDEO_ID?autoplay=1" frameborder="0" allowfullscreen></iframe>';
            codeModal.classList.add('hidden');
            secretCodeInput.value = '';
            errorMessage.classList.add('hidden');
        } else {
            errorMessage.classList.remove('hidden');
        }
    });
</script>
@endpush
