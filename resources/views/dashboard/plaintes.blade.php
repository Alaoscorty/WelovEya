@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 40px;
            }
        }

        .page-header {
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .page-header {
                margin-bottom: 30px;
            }
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        @media (min-width: 768px) {
            .page-title {
                font-size: 28px;
            }
        }

        .page-subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 25px;
        }

        .filters-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 25px;
        }

        @media (min-width: 768px) {
            .filters-section {
                flex-direction: row;
                flex-wrap: wrap;
            }
        }

        .search-bar-wrapper {
            position: relative;
            flex: 1;
            min-width: 100%;
        }

        @media (min-width: 768px) {
            .search-bar-wrapper {
                min-width: 300px;
            }
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
        }

        .search-bar {
            width: 100%;
            padding: 12px 20px;
            padding-left: 45px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }

        .search-bar::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .filter-dropdown {
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .filter-dropdown {
                padding: 12px 20px;
                font-size: 14px;
            }
        }

        .filter-dropdown:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .filter-dropdown i {
            font-size: 12px;
        }

        /* Table */
        .table-container {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead {
            background: rgba(255, 255, 255, 0.05);
        }

        th {
            padding: 12px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (min-width: 768px) {
            th {
                padding: 16px;
                font-size: 11px;
            }
        }

        td {
            padding: 12px 8px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 12px;
        }

        @media (min-width: 768px) {
            td {
                padding: 20px 16px;
                font-size: 14px;
            }
        }

        tbody tr {
            transition: background 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .complaint-id {
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
        }

        .client-info h4 {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        @media (min-width: 768px) {
            .client-info h4 {
                font-size: 14px;
            }
        }

        .client-info p {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
        }

        @media (min-width: 768px) {
            .client-info p {
                font-size: 12px;
            }
        }

        .complaint-type {
            font-size: 12px;
        }

        @media (min-width: 768px) {
            .complaint-type {
                font-size: 13px;
            }
        }

        .complaint-description {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .complaint-description {
                font-size: 13px;
                max-width: 300px;
            }
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
        }

        @media (min-width: 768px) {
            .status-badge {
                padding: 6px 14px;
                font-size: 11px;
            }
        }

        .status-ouvert {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .status-en-cours {
            background: rgba(251, 191, 36, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .status-résolu {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .date-time {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (min-width: 768px) {
            .date-time {
                font-size: 13px;
            }
        }

        .action-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: color 0.3s;
        }

        @media (min-width: 768px) {
            .action-link {
                font-size: 13px;
            }
        }

        .action-link:hover {
            color: #60a5fa;
            text-decoration: underline;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
            margin-top: 20px;
            padding: 0 5px;
        }

        @media (min-width: 768px) {
            .pagination-wrapper {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .pagination-info {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
        }

        @media (min-width: 768px) {
            .pagination-info {
                font-size: 14px;
            }
        }

        .pagination {
            display: flex;
            
        }



        .page-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
        }

        @media (min-width: 768px) {
            .page-btn {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }
        }

        .page-btn:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .page-btn.active {
            background: #3b82f6;
            border-color: #3b82f6;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Gestion des Plaintes Clients</h1>
                <p class="page-subtitle">Suivez et résolvez les problèmes des participants ici.</p>
            </div>

            <div class="filters-section">
                <div class="search-bar-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-bar" id="searchInput" placeholder="Rechercher par nom, email, ID de ticket...">
                </div>
                <div class="filter-dropdown" id="statusFilter">
                    <span>Statut : Tous</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="filter-dropdown" id="typeFilter">
                    <span>Type de Plainte : Tous</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID DE PLAINTE</th>
                            <th>NOM/EMAIL DU CLIENT</th>
                            <th>TYPE DE PLAINTE</th>
                            <th>DESCRIPTION COURTE</th>
                            <th>STATUT</th>
                            <th>DATE DE SOUMISSION</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="complaintsTable">
                        <tr data-status="ouvert" data-type="ticket">
                            <td><span class="complaint-id">PLT-10524</span></td>
                            <td>
                                <div class="client-info">
                                    <h4>Marie Dubois</h4>
                                    <p>marie.ds@email.com</p>
                                </div>
                            </td>
                            <td><span class="complaint-type">Problème de Ticket</span></td>
                            <td><span class="complaint-description">Le code du billet ne fonctionne pas...</span></td>
                            <td><span class="status-badge status-ouvert">Ouvert</span></td>
                            <td><span class="date-time">2024-07-21 14:30</span></td>
                            <td><a href="#" class="action-link">Voir Détails</a></td>
                        </tr>
                        <tr data-status="en-cours" data-type="streaming">
                            <td><span class="complaint-id">PLT-10523</span></td>
                            <td>
                                <div class="client-info">
                                    <h4>Jean Martin</h4>
                                    <p>j.martin@email.com</p>
                                </div>
                            </td>
                            <td><span class="complaint-type">Problème de Streaming</span></td>
                            <td><span class="complaint-description">Qualité vidéo très faible, impossible de...</span></td>
                            <td><span class="status-badge status-en-cours">En cours</span></td>
                            <td><span class="date-time">2024-07-21 11:05</span></td>
                            <td><a href="#" class="action-link">Voir Détails</a></td>
                        </tr>
                        <tr data-status="résolu" data-type="ticket">
                            <td><span class="complaint-id">PLT-10521</span></td>
                            <td>
                                <div class="client-info">
                                    <h4>Claire Petit</h4>
                                    <p>c.petit@email.com</p>
                                </div>
                            </td>
                            <td><span class="complaint-type">Problème de Ticket</span></td>
                            <td><span class="complaint-description">Je n'ai pas reçu mon billet par email apr...</span></td>
                            <td><span class="status-badge status-résolu">Résolu</span></td>
                            <td><span class="date-time">2024-07-20 09:15</span></td>
                            <td><a href="#" class="action-link">Voir Détails</a></td>
                        </tr>
                        <tr data-status="résolu" data-type="autre">
                            <td><span class="complaint-id">PLT-10520</span></td>
                            <td>
                                <div class="client-info">
                                    <h4>Lucas Bernard</h4>
                                    <p>l.bernard@email.com</p>
                                </div>
                            </td>
                            <td><span class="complaint-type">Autre</span></td>
                            <td><span class="complaint-description">Question sur les horaires de passage...</span></td>
                            <td><span class="status-badge status-résolu">Résolu</span></td>
                            <td><span class="date-time">2024-07-19 18:45</span></td>
                            <td><a href="#" class="action-link">Voir Détails</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Affichage de .. à .. sur .. résultats
                </div>
                <div class="pagination">
                    <button class="page-btn" id="prevBtn" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="page-btn active" data-page="1">1</button>
                    <button class="page-btn" data-page="2">2</button>
                    <button class="page-btn" data-page="3">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn" id="nextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </main>
@endsection
    
<script>
        // Menu interaction
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const complaintsTable = document.getElementById('complaintsTable');

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = complaintsTable.querySelectorAll('tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });

            updatePaginationInfo();
        });

        // Filter functionality
        const statusFilter = document.getElementById('statusFilter');
        const typeFilter = document.getElementById('typeFilter');
        let currentStatusFilter = 'tous';
        let currentTypeFilter = 'tous';

        statusFilter.addEventListener('click', function() {
            const statuses = ['tous', 'ouvert', 'en-cours', 'résolu'];
            const currentIndex = statuses.indexOf(currentStatusFilter);
            currentStatusFilter = statuses[(currentIndex + 1) % statuses.length];
            
            this.querySelector('span').textContent = `Statut : ${currentStatusFilter.charAt(0).toUpperCase() + currentStatusFilter.slice(1)}`;
            applyFilters();
        });

        typeFilter.addEventListener('click', function() {
            const types = ['tous', 'ticket', 'streaming', 'autre'];
            const currentIndex = types.indexOf(currentTypeFilter);
            currentTypeFilter = types[(currentIndex + 1) % types.length];
            
            this.querySelector('span').textContent = `Type de Plainte : ${currentTypeFilter.charAt(0).toUpperCase() + currentTypeFilter.slice(1)}`;
            applyFilters();
        });

        function applyFilters() {
            const rows = complaintsTable.querySelectorAll('tr');
            
            rows.forEach(row => {
                const status = row.dataset.status;
                const type = row.dataset.type;
                
                const statusMatch = currentStatusFilter === 'tous' || status === currentStatusFilter;
                const typeMatch = currentTypeFilter === 'tous' || type === currentTypeFilter;
                
                row.style.display = (statusMatch && typeMatch) ? '' : 'none';
            });

            updatePaginationInfo();
        }

        function updatePaginationInfo() {
            const visibleRows = Array.from(complaintsTable.querySelectorAll('tr')).filter(row => row.style.display !== 'none');
            const infoElement = document.querySelector('.pagination-info');
            infoElement.textContent = `Affichage de 1 à ${visibleRows.length} sur 25 résultats`;
        }

        // Pagination
        const pageButtons = document.querySelectorAll('.page-btn[data-page]');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        pageButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                pageButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const page = parseInt(this.dataset.page);
                prevBtn.disabled = page === 1;
            });
        });

        prevBtn.addEventListener('click', function() {
            const activePage = document.querySelector('.page-btn.active');
            const currentPage = parseInt(activePage.dataset.page);
            if (currentPage > 1) {
                pageButtons[currentPage - 2].click();
            }
        });

        nextBtn.addEventListener('click', function() {
            const activePage = document.querySelector('.page-btn.active');
            const currentPage = parseInt(activePage.dataset.page);
            if (currentPage < pageButtons.length) {
                pageButtons[currentPage].click();
            }
        });

        // Action links
        document.querySelectorAll('.action-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                const complaintId = row.querySelector('.complaint-id').textContent;
                const clientName = row.querySelector('.client-info h4').textContent;
                
                alert(`Affichage des détails de la plainte ${complaintId} pour ${clientName}`);
            });
        });
    </script>
    @push('scripts')
@endpush
