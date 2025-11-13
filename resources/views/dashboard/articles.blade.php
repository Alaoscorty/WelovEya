@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

        {{-- Main Content --}}
        <div class="ml-64 pl-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold mb-2">Gestion des articles</h1>
                <p class="text-slate-400">Visualisez et gérez tous vos articles</p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm mb-2">Total Articles livrés</p>
                            <p class="text-3xl font-bold">{{ $stats['total_articles'] ?? '28' }}</p>
                        </div>
                        <i data-lucide="package" class="text-orange-500 w-12 h-12"></i>
                    </div>
                </div>
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm mb-2">Stock Total actuel</p>
                            <p class="text-3xl font-bold">{{ $stats['total_stock'] ?? '1857' }}</p>
                        </div>
                        <i data-lucide="trending-up" class="text-red-500 w-12 h-12"></i>
                    </div>
                </div>
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm mb-2">Revenus générés</p>
                            <p class="text-3xl font-bold">{{ $stats['total_revenue'] ?? '45000 F' }}</p>
                        </div>
                        <i data-lucide="dollar-sign" class="text-orange-500 w-12 h-12"></i>
                    </div>
                </div>
            </div>

            {{-- Search and Filters --}}
            <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6 mb-6">
                <form id="searchForm" method="GET" action="{{ route('articles.index') }}">
                    <div class="flex items-center gap-4">
                        <div class="flex-1 relative">
                            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                            <input
                                type="text"
                                name="search"
                                id="searchTerm"
                                placeholder="Rechercher par type ou prix..."
                                value="{{ request('search') }}"
                                class="w-full bg-slate-900/50 border border-slate-600 rounded-lg pl-10 pr-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            />
                        </div>
                        <select
                            name="category"
                            id="selectedCategory"
                            class="bg-slate-900/50 border border-slate-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                            <option value="all">Catégorie</option>
                            <option value="urbanisme" {{ request('category') == 'urbanisme' ? 'selected' : '' }}>Urbanisme</option>
                            <option value="accessoires" {{ request('category') == 'accessoires' ? 'selected' : '' }}>Accessoires</option>
                        </select>
                        <a href="{{ route('articles.create') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                            <span>+</span> Ajouter un nouveau article
                        </a>
                        <button type="button" id="exportBtn" class="bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                            <i data-lucide="download" class="w-5 h-5"></i>
                            Exporter
                        </button>
                    </div>
                </form>
            </div>

            {{-- Articles Table --}}
            <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                    <input type="checkbox" id="selectAll" class="rounded">
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">ID Article</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nom de l'article</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Prix de vente</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Statut</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Stock global</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nb. de ventes</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Catégorie</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Description</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300"></th>
                            </tr>
                        </thead>
                        <tbody id="articlesTableBody">
                            @forelse($articles as $article)
                            <tr class="border-t border-slate-700 hover:bg-slate-700/30 transition">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rounded article-checkbox" value="{{ $article->id }}">
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $article->code }}</td>
                                <td class="px-6 py-4 text-sm font-medium">{{ $article->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ number_format($article->price, 0, ',', ' ') }} F</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        {{ $article->stock > 0 
                                            ? 'bg-green-500/20 text-green-400 border border-green-500/50' 
                                            : 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/50' }}">
                                        {{ $article->stock > 0 ? 'En stock' : 'En rupture' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $article->stock }}</td>
                                <td class="px-6 py-4 text-sm">{{ $article->sales_count }} (Vendus)</td>
                                <td class="px-6 py-4 text-sm">{{ $article->category }}</td>
                                <td class="px-6 py-4 text-sm text-slate-400 max-w-xs truncate">{{ $article->description }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('articles.variants', $article->id) }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 rounded-lg text-sm font-medium transition">
                                            Gérer les variantes
                                        </a>
                                        <a href="{{ route('articles.edit', $article->id) }}" class="p-2 hover:bg-slate-700 rounded-lg transition">
                                            <i data-lucide="edit" class="w-5 h-5"></i>
                                        </a>
                                        <button onclick="deleteArticle({{ $article->id }})" class="p-2 hover:bg-slate-700 rounded-lg transition">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center text-slate-400">
                                    Aucun article trouvé
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
            <div class="mt-6">
                {{ $articles->links() }}
            </div>
            @endif
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Search functionality with auto-submit
        const searchInput = document.getElementById('searchTerm');
        const categorySelect = document.getElementById('selectedCategory');
        const searchForm = document.getElementById('searchForm');

        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });

        categorySelect.addEventListener('change', function() {
            searchForm.submit();
        });

        // Select all checkboxes
        const selectAllCheckbox = document.getElementById('selectAll');
        const articleCheckboxes = document.querySelectorAll('.article-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            articleCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Export functionality
        document.getElementById('exportBtn').addEventListener('click', function() {
            const selectedIds = Array.from(articleCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert('Veuillez sélectionner au moins un article à exporter');
                return;
            }

            // Redirect to export route with selected IDs
            window.location.href = '{{ route("articles.export") }}?ids=' + selectedIds.join(',');
        });

        // Delete article function
        function deleteArticle(articleId) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
                return;
            }

            fetch(`/articles/${articleId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Article supprimé avec succès');
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            });
        }

        // Make delete function global
        window.deleteArticle = deleteArticle;
    </script>
@endsection

    @push('scripts')
@endpush