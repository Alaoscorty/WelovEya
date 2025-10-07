@extends('layouts.app')

@section('title', 'Artistes')

@section('content')

    <!-- Hero Section -->
    <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center mb-30">
            <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Concours & prix</h1>
            <p class="text-gray-300 max-w-3xl mx-auto text-lg mb-10">
                Tentez de gagnez nos tickets en participant à nos jeux concours
            </p>
            
        </div>
    </section>

    
    <!-- Footer -->
    <footer class="bg-black py-12 px-6 border-t border-gray-800">
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