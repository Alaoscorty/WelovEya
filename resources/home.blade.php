@extends('layouts.app')

@section('title', 'Artistes')

@section('content')

<section class="pt-16 pb-24 px-6">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Découvrez nos artistes</h1>
        <p class="text-gray-300 max-w-3xl mx-auto text-lg mb-10">
            Découvrez les plus grandes stars africaines et internationales qui enflamment la scène WeLoveEya
        </p>

        <!-- Recherche -->
        <div class="mt-16 flex justify-center">
            <input type="text" placeholder="Rechercher un artiste" class="w-full max-w-md p-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <i class="fa fa-search" style="margin-left: -4vh; margin-top: 2vh; font-size: 3vh;"></i>
        </div>
    </div>
</section>

<!-- Filtres -->
<section class="py-3 px-6">
    <div class="container mx-auto">
        <div class="flex justify-center space-x-4 mb-8">
            <button class="filter-btn bg-orange-500 text-white py-2 px-4 rounded" data-filter="all"><i class="fas fa-filter"></i></button>
            <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Afrobeat">Afrobeat</button>
            <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Rap Français">Rap Français</button>
            <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Coupé Décalé">Coupé Décalé</button>
            <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Scène Béninise">Scène Béninise</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-artist-card genre="Afrobeat" image="images/welove.webp" />
            <x-artist-card genre="Rap Français" image="images/OIP.jpeg" />
            <x-artist-card genre="Coupé Décalé" image="images/welove.webp" />
            <x-artist-card genre="Scène Béninise" image="images/OIP.jpeg" />
            <x-artist-card genre="Afrobeat" image="images/welove.webp" />
            <x-artist-card genre="Rap Français" image="images/OIP.jpeg" />
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

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
</script>
@endpush
