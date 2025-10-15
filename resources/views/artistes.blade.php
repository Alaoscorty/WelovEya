@extends('layouts.app')

@section('title', 'Artistes')

@section('content')

    <!-- Hero Section -->
    <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mt-6 mb-6 text-orange-500">Découvrez nos artistes</h1>
            <p class="text-gray-300 max-w-3xl mx-auto text-lg mb-10">
                Découvrez les plus grandes stars africaines et internationales qui enflamment la scène WeLoveEya
            </p>
            
            <!-- Countdown -->
            <div class="mt-16 flex justify-center">
                <input type="text" placeholder="Rechercher un artiste" class="w-full max-w-md p-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <i class="fa fa-search" data-feather="search" style="margin-left: -4vh; margin-top: 2vh; font-size: 3vh;"></i>
            </div>
        </div>
    </section>

    <!-- Discover Section -->
    <section class="py-3 px-6">
        <div class="container mx-auto">
            <!-- Filter Buttons -->
            <div class="flex justify-center space-x-4 mb-8">
                <button class="filter-btn bg-orange-500 text-white py-2 px-4 rounded" data-filter="all"><i class="fas fa-filter"></i></button>
                <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Afrobeat">Afrobeat</button>
                <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Rap Français">Rap Français</button>
                <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Coupé Décalé">Coupé Décalé</button>
                <button class="filter-btn bg-gray-700 text-white py-2 px-4 rounded" data-filter="Scène Béninise">Scène Béninise</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" data-genre="Afrobeat">
                    <div class="flex items-start mb-4">
                        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                            Afrobeat
                        </div>
                    </div>
                    <button class="mt-4  text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition" style="margin-top: 25vh; margin-left: 20vh; background-color: rgba(255, 255, 255, 0.267);">
                        Voter
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/OIP.jpeg);height:50vh;" data-genre="Rap Français">
                    <div class="flex items-start mb-4">
                        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                            Rap Français
                        </div>
                    </div>
                    <button class="mt-4  text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition" style="margin-top: 25vh; margin-left: 20vh; background-color: rgba(255, 255, 255, 0.267);">
                        Voter
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" data-genre="Coupé Décalé">
                    <div class="flex items-start mb-4">
                        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                            Coupé Décalé
                        </div>
                    </div>
                    <button class="mt-4  text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition"  style="margin-top: 25vh; margin-left: 20vh;background-color: rgba(255, 255, 255, 0.267);">
                        Voter
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/OIP.jpeg);height:50vh;" data-genre="Scène Béninise">
                    <div class="flex items-start mb-4">
                        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                            Scène Béninise
                        </div>
                    </div>
                    <button class="mt-4 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition"  style="margin-top: 25vh; margin-left: 20vh;background-color: rgba(255, 255, 255, 0.267);">
                        Voter
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" data-genre="Afrobeat">
                    <div class="flex items-start mb-4">
                        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition" >
                            Afrobeat
                        </div>
                    </div>
                    <button class="mt-4  text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition"  style="margin-top: 25vh; margin-left: 20vh;background-color: rgba(255, 255, 255, 0.267);">
                        Voter
                    </button>
                </div>
                <div class="card bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/OIP.jpeg); height:50vh;" data-genre="Rap Français">
                    <div class="flex items-start mb-4">
                        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                            Rap Français
                        </div>
                    </div>
                    <button class="mt-4 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition"  style="margin-top: 25vh; margin-left: 20vh;background-color: rgba(255, 255, 255, 0.267);">
                        Voter
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- section des animateurs -->
     <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mt-5 mb-5 text-orange-500">NOS ANIMATEURS</h1>
            
            <!-- Countdown -->
            <div class="mt-16 flex justify-center">
                <input type="text" placeholder="Rechercher un animateur" class="w-full max-w-md p-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8">
                <i class="fa fa-search" data-feather="search" style="margin-left: -4vh; margin-top: 2vh; font-size: 3vh;"></i>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class=" rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" ></div>
                <div class=" bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/OIP.jpeg);height:50vh;" ></div>
                <div class=" bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" ></div>
            </div>
        </div>
    </section>

    <!-- section des deejay -->
     <section class="pt-16 pb-24 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mt-5 mb-5 text-orange-500">NOS DEEJAY</h1>
            
            <!-- Countdown -->
            <div class="mt-16 flex justify-center">
                <input type="text" placeholder="Rechercher un DJ" class="w-full max-w-md p-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8">
                <i class="fa fa-search" data-feather="search" style="margin-left: -4vh; margin-top: 2vh; font-size: 3vh;"></i>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class=" rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" ></div>
                <div class=" bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/OIP.jpeg);height:50vh;" ></div>
                <div class=" bg-gray-800 rounded-xl p-6 hover-scale" style="background: url(images/welove.webp);height:50vh;" ></div>
            </div>
        </div>
    </section>

    @endsection

    @push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
