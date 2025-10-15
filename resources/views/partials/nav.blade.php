<nav class="bg-black py-4 px-6 border-b border-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/Logo-WLE_Plan-de-travail-1.png') }}" alt="Logo" width="50">

            </a>
            
            <div id="menu" class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/artistes') }}" class="text-white hover:text-orange-500">Artistes</a>
                <a href="{{ url('/billeterie') }}" class="text-white hover:text-orange-500">Billeterie & Location</a>
                <a href="{{ url('/direct') }}" class="text-white hover:text-orange-500">Direct <i class="fas fa-video" style="color: red;"></i></a>
                <a href="{{ url('/produit') }}" class="text-white hover:text-orange-500">Boutique</a>
                <a href="{{ url('/propos') }}"class="text-white hover:text-orange-500">A propos</a>
                <a href="{{ url('/jeux') }}" class="text-white hover:text-orange-500">Jeux</a>
            </div>
            <div class="flex items-center justify-end space-x-4">
                <!-- Menu button (burger or close) -->
                <button id="menu-toggle" class="text-white text-2xl focus:outline-none">
                    <i id="menu-icon" class="fas fa-bars"></i>
                </button>

                <!-- Shopping cart -->
                <div id="cart-btn" class="text-gray-600 hover:text-orange-600 relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"> 0 </span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Script -->
    <script>
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
                            )}FCFA</p>
                            <div class="flex items-center mt-2">
                                <button class="decrease-quantity text-gray-500 hover:text-orange-600" data-id="${
                                  item.id
                                }">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="quantity mx-2 text-gray-500">${
                                  item.quantity
                                }</span>
                                <button class="increase-quantity text-gray-500 hover:text-orange-600" data-id="${
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

      cartSubtotal.textContent = subtotal.toFixed(2) + "FCFA";
      cartTotal.textContent = subtotal.toFixed(2) + "FCFA";
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
    </script>
    <script>
                                // Met à jour le total dans le localStorage et l'affiche
                                function updateCartTotalLocal() {
                                    const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                                    localStorage.setItem('cartTotal', total);
                                    document.getElementById('cart-total-local').textContent = `FCFA ${total.toFixed(2)}`;
                                }
                                // Appelle la fonction à chaque mise à jour du panier
                                const _oldUpdateCartDisplay = updateCartDisplay;
                                updateCartDisplay = function() {
                                    _oldUpdateCartDisplay();
                                    updateCartTotalLocal();
                                };
                                // Initialise à l'ouverture du panier
                                updateCartTotalLocal();
                            </script>
</body>
</html>
