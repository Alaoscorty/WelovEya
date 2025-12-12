<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les opérations CRUD sur les commandes.
 * Ce contrôleur permet de créer, lire, mettre à jour et supprimer des commandes.
 */
class CommandeController extends Controller
{
    /**
     * Affiche la liste des commandes.
     * Redirige vers le contrôleur DashboardController pour l'affichage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Redirection vers la méthode commandes du DashboardController
        return app(DashboardController::class)->commandes($request);
    }

    /**
     * Affiche les détails d'une commande spécifique.
     * Récupère la commande avec ses articles.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupération de la commande avec ses articles
        $commande = Commande::with('articles')->findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailcommande', compact('commande'));
    }

    /**
     * Met à jour le statut d'une commande.
     * Permet de changer le statut (en cours, livree, annulee).
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatut(Request $request, $id)
    {
        // Récupération de la commande
        $commande = Commande::findOrFail($id);

        // Validation du statut
        $request->validate([
            'statut' => 'required|in:en_cours,livree,annulee',
        ]);

        // Mise à jour du statut
        $commande->update(['statut' => $request->statut]);

        // Si la commande est annulée, remettre le stock en place
        if ($request->statut === 'annulee') {
            foreach ($commande->articles as $article) {
                $article->increment('stock_global', $article->pivot->quantite);
            }
        }

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès.');
    }

    /**
     * Supprime une commande de la base de données.
     * Vérifie d'abord qu'elle n'est pas déjà livrée.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Récupération de la commande
        $commande = Commande::findOrFail($id);

        // Vérification du statut (ne pas supprimer si livrée)
        if ($commande->statut === 'livree') {
            return redirect()->back()->with('error', 'Impossible de supprimer une commande déjà livrée.');
        }

        // Si la commande est en cours, remettre le stock en place
        if ($commande->statut === 'en_cours') {
            foreach ($commande->articles as $article) {
                $article->increment('stock_global', $article->pivot->quantite);
            }
        }

        // Suppression de la commande
        $commande->delete();

        // Redirection avec message de succès
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }

    /**
     * Calcule le total d'une commande.
     * Méthode utilitaire pour recalculer le total basé sur les articles.
     *
     * @param Commande $commande
     * @return float
     */
    private function calculerTotal(Commande $commande)
    {
        $total = 0;
        foreach ($commande->articles as $article) {
            $total += $article->prix_vente * $article->pivot->quantite;
        }
        return $total;
    }
}
