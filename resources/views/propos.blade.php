@extends('layouts.app')

@section('title', 'Artistes')

@section('content')
<!-- contenue du code -->
 <!-- SECTION : NOTRE MISSION -->
  <section class="max-w-6xl mx-auto px-6 py-16 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-12">
      <span class="text-orange-800">NOTRE MISSION</span><br>
    </h2>

    <!-- Cartes mission -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-3 gap-6 mb-6 text-center">
      <div class="card border border-white">
        <p class="text-3xl mb-3">
            <i class="fas fa-friend"></i>
        </p>
        <h3 class="font-bold mb-2">Rassembler</h3>
        <p class="text-sm text-gray-300">Créer une communauté soudée autour de valeurs communes et d’actions concrètes</p>
      </div>
      <div class="card border border-white">
        <p class="text-3xl mb-3">
            <i class="fas fa-heart"></i>
        </p>
        <h3 class="font-bold mb-2">Agir</h3>
        <p class="text-sm text-gray-300">Encourager les actions bénéfiques qui valorisent l’entraide et la différence</p>
      </div>
      <div class="card border border-white">
        <p class="text-3xl mb-3">🏅
            <i></i>
        </p>
        <h3 class="font-bold mb-2">Récompenser</h3>
        <p class="text-sm text-gray-300">Valoriser l’engagement de chacun avec des récompenses et des opportunités uniques</p>
      </div>
    </div>

    <!-- Texte principal -->
    <p class="card text-gray-300 max-w-5xl mx-auto mb-10 leading-relaxed border w-full border-white rounded-lg p-6">
      <span class="text-orange-800 font-bold">WELOVEVA</span> est bien plus qu’un simple évènement. C’est une plateforme innovante qui récompense votre générosité. 
      Participez à des activités solidaires, gagnez des tickets et tentez votre chance pour remporter des prix tout en contribuant à un monde meilleur. 
      Ensemble, transformons l’engagement en célébration !
    </p>
  </section>

  <!-- OBJECTIF DU FESTIVAL -->
  <section class="max-w-6xl mx-auto px-6 py-16">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-orange-800 mb-12">OBJECTIF DU FESTIVAL</h2>

    <div class="flex flex-col lg:flex-row items-start gap-10">
      <div class="lg:w-1/2 space-y-6">
        <h3 class="text-xl font-semibold uppercase">Une ambition sociale forte au cœur du festival</h3>
        <p class="text-gray-300 leading-relaxed">
          Au-delà de la musique et des performances, notre festival WeLovEva s’engage activement pour un avenir meilleur pour les jeunes et les communautés du Bénin. 
          Chaque ticket acheté contribue directement à la construction de cantines, foyers et infrastructures sociales importantes à travers le territoire.
        </p>
        <p class="text-gray-300 leading-relaxed">
          Parce que nous croyons que cet évènement doit être accessible à tous, nous offrons au jeunes une opportunités unique: <span class="text-orange-800">obtenir un tickets gratuitement </span>
          en échange de quelques heures de travail au service de leur communautés
        </p>
        <p class="text-gray-300 leading-relaxed">
          En somme, en participant au festival, chaque festivalier devient acteur du changement, soutenant notamment nos actions sociales tout en célébrant la culture.
        </p>
        <p class="text-orange-800">
            Rejoignez nous et vivez un moment unique en sachant que votre présence ici contribue à bâtir l'avenir de demain
        </p>
        <a href="#" class="inline-block mt-4 px-6 py-2 bg-orange-800 text-white rounded-lg">En savoir plus</a>
      </div>

      <div class="lg:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-4 block">
        <img src="https://i.imgur.com/h7qgHkC.jpeg" alt="Projet social 1" class="rounded-xl">
        <img src="https://i.imgur.com/8ocHKbe.jpeg" alt="Projet social 2" class="rounded-xl">
      </div>
    </div>
  </section>

  <!-- COMMENT ÇA MARCHE -->
  <section class="max-w-6xl mx-auto px-6 py-16 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-orange-800 mb-6">Comment ça marche ?</h2>
    <p class="text-gray-300 mb-12">Trois étapes simples pour transformer votre engagement en opportunités :</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="">
        <p class="text-3xl mb-3">💬</p>
        <h3 class="font-bold mb-2">Participer</h3>
        <p class="text-sm text-gray-300">Engagez-vous dans une activité solidaire de votre choix</p>
      </div>
      <div class="">
        <p class="text-3xl mb-3">🎟️</p>
        <h3 class="font-bold mb-2">Gagner des tickets</h3>
        <p class="text-sm text-gray-300">Gagnez des tickets pour chaque action bénévole accomplie</p>
      </div>
      <div class="">
        <p class="text-3xl mb-3">🏆</p>
        <h3 class="font-bold mb-2">Gagner des lots</h3>
        <p class="text-sm text-gray-300">Accédez à des récompenses exclusives pour chaque engagement accompli</p>
      </div>
    </div>
  </section>

  <!-- NOS VALEURS -->
    <section class="max-w-6xl mx-auto px-6 py-16 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-orange-800 mb-12">Nos Valeurs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="card   border border-white">
                <h3 class="font-bold mb-2">Solidarité</h3>
                <p class="text-sm text-gray-300">L’entraide et le soutien mutuel sont au cœur de notre démarche</p>
            </div>
            <div class="card border border-white">
                <h3 class="font-bold mb-2">Engagement</h3>
                <p class="text-sm text-gray-300">Nous valorisons l’action concrète et l’implication de chacun</p>
            </div>
            <div class="card border border-white">  
                <h3 class="font-bold mb-2">Communauté</h3>    
                <p class="text-sm text-gray-300">
                    Ensemble, nous sommes plus forts et créons un impact durable
                </p>   
            </div>
            <div class="card border border-white">  
                <h3 class="font-bold mb-2">Partage</h3>   
                <p class="text-sm text-gray-300">
                    Diffuser un esprit collectif et inspirer d’autres à nous rejoindre
                </p>    
            </div>
        </div>
    </section>

  <!-- ÉQUIPE ORGANISATRICE -->
    <section class="max-w-6xl mx-auto px-6 py-16 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-orange-800 mb-6">L’équipe organisatrice</h2>
        <p class="text-gray-300 mb-10">
            Des personnes passionnées et engagées qui donnent vie à WeLovEva
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="card border border-white">
                <h3 class="text-orange font-bold mb-1">SM</h3>
                <p class="font-semibold">Sophie Martin</p>
                <p class="text-sm text-gray-300">Coordination</p>
            </div>
            <div class="card border border-white">
                <h3 class="text-orange font-bold mb-1">LD</h3>
                <p class="font-semibold">Lucas Dubois</p>
                <p class="text-sm text-gray-300">Communication</p>
            </div>
            <div class="card border border-white">
                <h3 class="text-orange font-bold mb-1">ES</h3>
                <p class="font-semibold">Emma Sennwe</p>
                <p class="text-sm text-gray-300">Relations Artistes</p>
            </div>
            <div class="card border border-white">
                <h3 class="text-orange font-bold mb-1">TP</h3>
                <p class="font-semibold">Thomas Petit</p>
                <p class="text-sm text-gray-300">Partenariats Nationaux</p>
            </div>
        </div>
    </section>
<footer class="bg-black py-12 px-6 border-t border-gray-800 mt-20">
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

