<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commande;
use App\Models\Ticket;
use App\Models\Revendeur;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les fonctionnalités du tableau de bord.
 * Ce contrôleur gère l'affichage des statistiques et des données principales du dashboard.
 */
class DashboardController extends Controller
{
    /**
     * Affiche la page d'accueil du tableau de bord.
     * Récupère les statistiques principales et les affiche sur la vue.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupération des statistiques principales
        $ticketsSold = Ticket::where('statut', 'vendu')->count(); // Nombre de tickets vendus
        $activeResellers = Revendeur::where('statut', 'actif')->count(); // Nombre de revendeurs actifs
        $totalRevenue = Ticket::where('statut', 'vendu')->sum('prix') + Commande::sum('total'); // Revenus totaux
        $benefits = $totalRevenue * 0.3; // Bénéfices estimés (30% des revenus)

        // Retour de la vue avec les données
        return view('dashboard.index', compact(
            'ticketsSold',
            'activeResellers',
            'totalRevenue',
            'benefits'
        ));
    }

    /**
     * Affiche la liste des articles avec pagination et filtres.
     * Permet de gérer l'affichage des articles dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function articles(Request $request)
    {
        // Récupération des paramètres de recherche et de filtrage
        $search = $request->get('search'); // Terme de recherche
        $category = $request->get('category'); // Filtre par catégorie

        // Construction de la requête pour les articles
        $query = Article::query();

        // Application des filtres
        if ($search) {
            $query->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($category && $category !== 'Catégorie') {
            $query->where('categorie', $category);
        }

        // Récupération des articles avec pagination
        $articles = $query->paginate(10);

        // Statistiques des articles
        $totalArticles = Article::count(); // Nombre total d'articles
        $totalStock = Article::sum('stock_global'); // Stock total
        $totalRevenue = Commande::sum('total'); // Revenus générés

        // Retour de la vue avec les données
        return view('dashboard.articles', compact(
            'articles',
            'totalArticles',
            'totalStock',
            'totalRevenue',
            'search',
            'category'
        ));
    }

    /**
     * Affiche la liste des commandes avec pagination.
     * Permet de visualiser et gérer les commandes dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function commandes(Request $request)
    {
        // Récupération des commandes avec pagination
        $commandes = Commande::with('articles')->paginate(15);

        // Retour de la vue avec les données
        return view('dashboard.commandes', compact('commandes'));
    }

    /**
     * Affiche les détails d'une commande spécifique.
     * Permet de voir les informations détaillées d'une commande.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function detailCommande($id)
    {
        // Récupération de la commande avec ses articles
        $commande = Commande::with('articles')->findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailcommande', compact('commande'));
    }

    /**
     * Affiche la liste des revendeurs avec pagination.
     * Permet de gérer les revendeurs dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function revendeurs(Request $request)
    {
        // Récupération des revendeurs avec pagination
        $revendeurs = Revendeur::paginate(10);

        // Retour de la vue avec les données
        return view('dashboard.revendeur', compact('revendeurs'));
    }

    /**
     * Affiche les détails d'un revendeur spécifique.
     * Permet de voir les informations détaillées d'un revendeur.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function detailRevendeur($id)
    {
        // Récupération du revendeur
        $revendeur = Revendeur::findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailrevendeur', compact('revendeur'));
    }

    /**
     * Affiche la liste des intervenants avec pagination.
     * Permet de gérer les intervenants dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function intervenants(Request $request)
    {
        // Récupération des intervenants avec pagination
        $intervenants = \App\Models\Intervenant::paginate(10);

        // Retour de la vue avec les données
        return view('dashboard.intervenants', compact('intervenants'));
    }

    /**
     * Affiche les détails d'un intervenant spécifique.
     * Permet de voir les informations détaillées d'un intervenant.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function detailIntervenant($id)
    {
        // Récupération de l'intervenant
        $intervenant = \App\Models\Intervenant::findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailIntervenant', compact('intervenant'));
    }

    /**
     * Affiche la liste des jeux avec pagination.
     * Permet de gérer les jeux dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function jeux(Request $request)
    {
        // Récupération des jeux avec pagination
        $jeux = \App\Models\Jeu::paginate(10);

        // Retour de la vue avec les données
        return view('dashboard.Jeux', compact('jeux'));
    }

    /**
     * Affiche la liste des activités avec pagination.
     * Permet de gérer les activités dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function activites(Request $request)
    {
        // Récupération des activités avec pagination
        $activites = \App\Models\Activite::paginate(10);

        // Retour de la vue avec les données
        return view('dashboard.activites', compact('activites'));
    }

    /**
     * Affiche la liste des plaintes avec pagination.
     * Permet de gérer les plaintes dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function plaintes(Request $request)
    {
        // Récupération des plaintes avec pagination
        $plaintes = \App\Models\Plainte::with('user')->paginate(10);

        // Retour de la vue avec les données
        return view('dashboard.plaintes', compact('plaintes'));
    }

    /**
     * Affiche les bénéfices et statistiques financières.
     * Permet de visualiser les performances financières du système.
     *
     * @return \Illuminate\View\View
     */
    public function benefices()
    {
        // Calcul des bénéfices
        $totalRevenue = Ticket::where('statut', 'vendu')->sum('prix') + Commande::sum('total');
        $totalCosts = 0; // À calculer selon les coûts réels
        $benefits = $totalRevenue - $totalCosts;

        // Retour de la vue avec les données
        return view('dashboard.benefices', compact('totalRevenue', 'totalCosts', 'benefits'));
    }

    /**
     * Affiche la liste des billets/tickets avec pagination.
     * Permet de gérer les tickets dans le dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function billets(Request $request)
    {
        // Récupération des tickets avec pagination
        $billets = Ticket::paginate(15);

        // Retour de la vue avec les données
        return view('dashboard.billets', compact('billets'));
    }

    /**
     * Affiche les paramètres du système.
     * Permet de configurer les paramètres généraux du dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function parametres()
    {
        // Retour de la vue des paramètres
        return view('dashboard.parametres');
    }
}
