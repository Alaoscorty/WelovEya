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
document.addEventListener('DOMContentLoaded', function() {
    // ------------------------
        // CHAT EN TEMPS RÉEL AVEC ECHO
        // ------------------------

        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config("broadcasting.connections.pusher.key") }}',
            cluster: '{{ config("broadcasting.connections.pusher.options.cluster") }}',
            forceTLS: true
        });

        const chatBox = document.getElementById('chatMessages');
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const onlineNumber = document.getElementById('onlineNumber');
        const messageSound = new Audio('{{ asset("sounds/new-message.mp3") }}');

        sendButton?.addEventListener('click', sendMessage);
        messageInput?.addEventListener('keypress', e => {
            if (e.key === 'Enter') sendMessage();
        });

        function sendMessage() {
            const content = messageInput.value.trim();
            if (!content) return;
            axios.post('/chat/send', { content })
                .then(() => {
                    messageInput.value = '';
                })
                .catch(err => {
                    console.error('Erreur envoi message :', err);
                    alert('Erreur lors de l’envoi du message.');
                });
        }

        function displayMessage(msg, highlight = true) {
            const div = document.createElement('div');
            div.className = 'bg-gray-800 p-2 rounded-lg mb-1 transition-opacity duration-500';
            if (highlight) div.style.opacity = 0;
            div.innerHTML = `
                <span class="text-blue-400 font-semibold">${msg.pseudo}</span>
                <span class="text-gray-300 text-sm">: ${msg.content}</span>
                <span class="text-gray-500 text-xs ml-2">${msg.created_at?.substring(11, 16) || ''}</span>
            `;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
            if (highlight) {
                setTimeout(() => div.style.opacity = 1, 50);
                messageSound.play().catch(() => {});
            }
        }

        window.Echo.channel('chat')
            .listen('MessageSent', e => {
                displayMessage(e.message);
                if (e.onlineCount !== undefined && onlineNumber) {
                    onlineNumber.textContent = e.onlineCount;
                }
            });

        window.Echo.join('chat.presence')
            .here(users => {
                if (onlineNumber) onlineNumber.textContent = users.length;
            })
            .joining(() => {
                if (onlineNumber) onlineNumber.textContent = parseInt(onlineNumber.textContent) + 1;
            })
            .leaving(() => {
                if (onlineNumber) onlineNumber.textContent = parseInt(onlineNumber.textContent) - 1;
            });
});