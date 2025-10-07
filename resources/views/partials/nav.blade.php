<nav class="bg-black py-4 px-6 border-b border-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/Logo-WLE_Plan-de-travail-1.png') }}" alt="Logo" width="50">

            </div>
            
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
                <div id="cart-icon" class="text-white text-2xl">
                    <i class="fas fa-shopping-cart"></i>
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
    </script>
</body>
</html>
