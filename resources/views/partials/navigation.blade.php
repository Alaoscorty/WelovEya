
        <!-- Sidebar -->
        <aside class="w-64 bg-[#0f1229] p-4 md:p-6 flex flex-col border-r border-white/5">
            <!-- Logo -->
            <div class="flex items-center gap-2.5 mb-6 text-base font-semibold text-[#ff8c42] px-2">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/Logo-WLE_Plan-de-travail-1.png') }}" alt="Logo" width="50">
                </a>
                <span>WELOVEYA</span>
            </div>

            <!-- Search Box -->
            <div class="relative mb-8">
                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                <input type="text" placeholder="Rechercher......" 
                    class="w-full py-2.5 px-3.5 pl-10 bg-[#1a1f3a] border border-[#2a2f4a] rounded-md text-white text-xs placeholder-gray-500 focus:outline-none focus:border-[#667eea]">
            </div>
            

            <nav class="flex flex-col gap-1 flex-1">
                <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('dashboard')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-chart-pie w-4.5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/tickets') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('tickets')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-ticket-alt w-4.5"></i>
                    <span>Tickets</span>
                </a>

                <a href="{{ url('/dashboard/billets-streaming') }}" 
   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all 
   @if(request()->is('billets_streaming')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
   <i class="fas fa-video w-4.5"></i>
   <span>Billets streaming</span>
</a>


                <a href="{{ url('/revendeurs') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('revendeurs')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-dollar-sign w-4.5"></i>
                    <span>Revendeurs</span>
                </a>

                <a href="{{ url('/articles') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('articles')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-newspaper w-4.5"></i>
                    <span>Articles</span>
                </a>

                <a href="{{ url('/commandes') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('commandes')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-shopping-cart w-4.5"></i>
                    <span>Commandes</span>
                </a>

                <a href="{{ url('dashboard/intervenants') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('intervenants')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-users w-4.5"></i>
                    <span>Intervenants</span>
                </a>

                <a href="{{ url('/jeux') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('jeux')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-gamepad w-4.5"></i>
                    <span>Jeux concours</span>
                </a>

                <a href="{{ url('/activites') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('activites')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-chart-bar w-4.5"></i>
                    <span>Activités</span>
                </a>

                <a href="{{ url('/plaintes') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('plaintes')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-comments w-4.5"></i>
                    <span>Plaintes des clients</span>
                </a>

                <a href="{{ url('/benefices') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('benefices')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-gift w-4.5"></i>
                    <span>Bénéfices</span>
                </a>
                
                <a href="{{ url('/parametres') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-all @if(request()->is('parametres')) bg-gradient-to-r from-[#ff6b35] to-[#ff8c42] text-white shadow-lg shadow-[#ff6c35]/30 @else text-gray-400 hover:bg-[#1a1f3a] hover:text-white @endif">
                    <i class="fas fa-cog w-4.5"></i>
                    <span>Paramètres</span>
                </a>
            </nav>
            
            <!-- User Profile -->
            <div class="flex items-center gap-3 p-3.5 bg-[#1a1f3a] rounded-xl mt-auto">
                <div class="w-9 h-9 bg-gradient-to-br from-[#667ea] to-[#764ba2] rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="text-xs font-semibold text-white mb-0.5">{{ Auth::user()->name ?? 'John Carter' }}</div>
                    <div class="text-[11px] text-gray-500">Admin</div>
                </div>
            </div>
        </aside>
    
</body>
</html>
