document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menu-toggle");
        const menu = document.getElementById("menu");
        const menuIcon = document.getElementById("menu-icon");
        const cartIcon = document.getElementById("cart-icon");

        let isOpen = false;

        menuToggle.addEventListener("click", function () {
            isOpen = !isOpen;

            if (isOpen) {
                // Affiche le menu, change l'icône en croix, cache le panier
                menu.style.display = "block";
                menuIcon.classList.remove("fa-bars");
                menuIcon.classList.add("fa-times");
                cartIcon.style.display = "none";
            } else {
                // Cache le menu, remet l'icône burger, affiche le panier
                menu.style.display = "none";
                menuIcon.classList.remove("fa-times");
                menuIcon.classList.add("fa-bars");
                cartIcon.style.display = "block";
            }
        });
    });
});

//script pour gérer le filtre d'évènement 
document.addEventListener('DOMContentLoaded', function() {
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

//script de gestion des produits
document.addEventListener("DOMContentLoaded", () => {
    // Cart functionality
  const cartBtn = document.getElementById("cart-btn");
  const cartSidebar = document.getElementById("cart-sidebar");
  const closeCartBtn = document.getElementById("close-cart");
  const cartOverlay = document.getElementById("cart-overlay");
  const cartCount = document.getElementById("cart-count");
  const cartItemsContainer = document.getElementById("cart-items");
  const emptyCartMessage = document.getElementById("empty-cart-message");
  const cartSummary = document.getElementById("cart-summary");
  const cartSubtotal = document.getElementById("cart-subtotal");
  const cartTotal = document.getElementById("cart-total");

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Update cart count
  function updateCartCount() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    if (totalItems > 0) {
      cartCount.classList.remove("hidden");
    } else {
      cartCount.classList.add("hidden");
    }
  }

  // Update cart sidebar
  function updateCartSidebar() {
    cartItemsContainer.innerHTML = "";

    if (cart.length === 0) {
      emptyCartMessage.classList.remove("hidden");
      cartSummary.classList.add("hidden");
    } else {
      emptyCartMessage.classList.add("hidden");

      let subtotal = 0;

      cart.forEach((item) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;

        const cartItem = document.createElement("div");
        cartItem.className = "flex items-start py-4 border-b border-gray-200";
        cartItem.innerHTML = `
                        <img src="${item.image}" alt="${
          item.name
        }" class="w-16 h-16 object-cover rounded">
                        <div class="ml-4 flex-grow">
                            <h4 class="font-medium">${item.name}</h4>
                            <p class="text-gray-600 text-sm">${item.price.toFixed(
                              2
                            )}€</p>
                            <div class="flex items-center mt-2">
                                <button class="decrease-quantity text-gray-500 hover:text-pink-600" data-id="${
                                  item.id
                                }">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="quantity mx-2">${
                                  item.quantity
                                }</span>
                                <button class="increase-quantity text-gray-500 hover:text-pink-600" data-id="${
                                  item.id
                                }">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <button class="remove-item text-gray-400 hover:text-red-500 ml-2" data-id="${
                          item.id
                        }">
                            <i class="fas fa-times"></i>
                        </button>
                    `;

        cartItemsContainer.appendChild(cartItem);
      });

      cartSubtotal.textContent = subtotal.toFixed(2) + "€";
      cartTotal.textContent = subtotal.toFixed(2) + "€";
      cartSummary.classList.remove("hidden");
    }
  }

  // Add to cart
  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const name = this.getAttribute("data-name");
      const price = parseFloat(this.getAttribute("data-price"));
      const image = this.getAttribute("data-image");

      const existingItem = cart.find((item) => item.id === id);

      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({
          id,
          name,
          price,
          image,
          quantity: 1,
        });
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
      updateCartSidebar();

      // Show cart sidebar when adding an item
      cartSidebar.classList.remove("translate-x-full");
      cartOverlay.classList.remove("hidden");
      document.body.style.overflow = "hidden";
    });
  });

  // Cart sidebar toggle
  cartBtn.addEventListener("click", () => {
    cartSidebar.classList.remove("translate-x-full");
    cartOverlay.classList.remove("hidden");
    document.body.style.overflow = "hidden";
    updateCartSidebar();
  });

  closeCartBtn.addEventListener("click", () => {
    cartSidebar.classList.add("translate-x-full");
    cartOverlay.classList.add("hidden");
    document.body.style.overflow = "auto";
  });

  cartOverlay.addEventListener("click", () => {
    cartSidebar.classList.add("translate-x-full");
    cartOverlay.classList.add("hidden");
    document.body.style.overflow = "auto";
  });

  // Handle cart item quantity changes and removal
  document.addEventListener("click", function (e) {
    // Decrease quantity
    if (
      e.target.classList.contains("decrease-quantity") ||
      e.target.closest(".decrease-quantity")
    ) {
      const button = e.target.classList.contains("decrease-quantity")
        ? e.target
        : e.target.closest(".decrease-quantity");
      const id = button.getAttribute("data-id");
      const item = cart.find((item) => item.id === id);

      if (item.quantity > 1) {
        item.quantity -= 1;
      } else {
        cart = cart.filter((item) => item.id !== id);
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
      updateCartSidebar();
    }

    // Increase quantity
    if (
      e.target.classList.contains("increase-quantity") ||
      e.target.closest(".increase-quantity")
    ) {
      const button = e.target.classList.contains("increase-quantity")
        ? e.target
        : e.target.closest(".increase-quantity");
      const id = button.getAttribute("data-id");
      const item = cart.find((item) => item.id === id);

      item.quantity += 1;

      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
      updateCartSidebar();
    }

    // Remove item
    if (
      e.target.classList.contains("remove-item") ||
      e.target.closest(".remove-item")
    ) {
      const button = e.target.classList.contains("remove-item")
        ? e.target
        : e.target.closest(".remove-item");
      const id = button.getAttribute("data-id");

      cart = cart.filter((item) => item.id !== id);

      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
      updateCartSidebar();
    }
  });

  // Initialize cart on page load
  updateCartCount();
});