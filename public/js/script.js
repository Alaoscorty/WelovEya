document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
    
    
    // Hide menu when a link is clicked
    const menuLinks = menu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.add('hidden');
        });
    });

    const filterButtons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');
            filterButtons.forEach(b => {
                b.classList.remove('bg-orange-500');
                b.classList.add('bg-gray-700');
            });
            btn.classList.remove('bg-gray-700');
            btn.classList.add('bg-orange-500');

            cards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-genre') === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

//script pour la gestion du carousel
document.addEventListener('DOMContentLoaded', function() {

    feather.replace();

    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevButton = document.getElementById('prev-slide');
    const nextButton = document.getElementById('next-slide');
    let currentSlide = 0;
    let slideInterval = setInterval(nextSlide, 5000);

    function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('active-slide'));
        slides.forEach(slide => slide.classList.add('inactive-slide'));
        slides[n].classList.remove('inactive-slide');
        slides[n].classList.add('active-slide');
        
        dots.forEach(dot => dot.classList.remove('active'));
        dots[n].classList.add('active');
        
        currentSlide = n;
    }

    function nextSlide() {
        let newSlide = currentSlide + 1;
        if (newSlide >= slides.length) {
            newSlide = 0;
        }
        showSlide(newSlide);
        resetInterval();
    }

    function prevSlide() {
        let newSlide = currentSlide - 1;
        if (newSlide < 0) {
            newSlide = slides.length - 1;
        }
        showSlide(newSlide);
        resetInterval();
    }

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
    }

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideIndex = parseInt(this.getAttribute('data-slide'));
            showSlide(slideIndex);
            resetInterval();
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') {
            nextSlide();
        } else if (e.key === 'ArrowLeft') {
            prevSlide();
        }
    });

    // Touch events for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, false);

    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);

    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            nextSlide();
        }
        if (touchEndX > touchStartX + 50) {
            prevSlide();
        }
    }
});


//script pour la gestion du chat
//script pour la gestion du chat
document.addEventListener("DOMContentLoaded", () => {
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const sendButton = document.getElementById('sendButton');
    const sendSound = document.getElementById('sendSound');
    const receiveSound = document.getElementById('receiveSound');
    const onlineCount = document.getElementById('onlineCount');

    // Emoji Picker
    const emojiButton = document.getElementById('emojiButton');
    const picker = document.createElement('emoji-picker');
    picker.style.position = 'absolute';
    picker.style.top = '180vh';
    picker.style.bottom = '90px';
    picker.style.right = '40px';
    picker.style.display = 'none';
    document.body.appendChild(picker);

    emojiButton.addEventListener('click', () => {
        picker.style.display = picker.style.display === 'none' ? 'block' : 'none';
    });

    picker.addEventListener('emoji-click', e => {
        messageInput.value += e.detail.unicode;
        picker.style.display = 'none';
    });

    // Charger les messages initiaux
    fetch('/messages')
        .then(res => res.json())
        .then(data => {
            chatMessages.innerHTML = '';
            data.forEach(msg => appendMessage(msg));
        });

    function appendMessage(msg) {
        const div = document.createElement('div');
        div.className = 'bg-gray-800 rounded-lg p-2';
        div.innerHTML = `<span class="text-blue-400 font-bold">${msg.pseudo} :</span> ${msg.message}`;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Envoyer message
    sendButton.addEventListener('click', async () => {
        const message = messageInput.value.trim();
        if (!message) return;

        sendSound.play();

        const res = await fetch('/messages', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ message })
        });
        const data = await res.json();
        appendMessage(data);
        messageInput.value = '';
    });

    // Laravel Echo (écoute en temps réel)
    window.Echo.channel('chat')
        .listen('.message.sent', (e) => {
            appendMessage(e.message);
            receiveSound.play();
        });

    // Mise à jour du nombre d’utilisateurs
    setInterval(async () => {
        const res = await fetch('/online-users');
        const data = await res.json();
        onlineCount.textContent = data.count;
    }, 5000);
});

//Script de gestion de l'évènemnt
// Date de l'événement : 26 décembre 2025 à 00:00:00
const eventDate = new Date('December 26, 2025 00:00:00').getTime();

function updateCountdown() {
    // Date actuelle
    const now = new Date().getTime();
    
    // Différence entre la date de l'événement et maintenant
    const distance = eventDate - now;
    
    // Calculs pour les jours, heures, minutes et secondes
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Mise à jour de l'affichage avec un zéro devant si nécessaire
    document.getElementById('days').textContent = days;
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    
    // Si le compte à rebours est terminé
    if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById('days').textContent = '00';
        document.getElementById('hours').textContent = '00';
        document.getElementById('minutes').textContent = '00';
        document.getElementById('seconds').textContent = '00';
    }
}

// Mettre à jour le compte à rebours immédiatement
updateCountdown();

// Mettre à jour le compte à rebours toutes les secondes
const countdownInterval = setInterval(updateCountdown, 1000);