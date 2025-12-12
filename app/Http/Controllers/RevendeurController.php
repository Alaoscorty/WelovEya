<?php

namespace App\Http\Controllers;

use App\Models\Revendeur;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les opérations CRUD sur les revendeurs.
 * Ce contrôleur permet de créer, lire, mettre à jour et supprimer des revendeurs.
 */
class RevendeurController extends Controller
{
    /**
     * Affiche la liste des revendeurs.
     * Redirige vers le contrôleur DashboardController pour l'affichage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Redirection vers la méthode revendeurs du DashboardController
        return app(DashboardController::class)->revendeurs($request);
    }

    /**
     * Affiche le formulaire de création d'un nouveau revendeur.
     * Prépare les données nécessaires pour le formulaire.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retour de la vue du formulaire de création
        return view('dashboard.ajouterrevendeur');
    }

    /**
     * Stocke un nouveau revendeur en base de données.
     * Valide les données et crée le revendeur.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:revendeurs',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'statut' => 'required|in:actif,inactif,suspendu',
        ]);

        // Ajout de la date d'inscription
        $validated['date_inscription'] = now();

        // Création du revendeur
        Revendeur::create($validated);

        // Redirection avec message de succès
        return redirect()->route('revendeurs.index')->with('success', 'Revendeur créé avec succès.');
    }

    /**
     * Affiche les détails d'un revendeur spécifique.
     * Récupère le revendeur avec ses tickets et commandes.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupération du revendeur avec ses relations
        $revendeur = Revendeur::with(['tickets', 'commandes'])->findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailrevendeur', compact('revendeur'));
    }

    /**
     * Affiche le formulaire d'édition d'un revendeur.
     * Prépare les données du revendeur pour l'édition.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupération du revendeur
        $revendeur = Revendeur::findOrFail($id);

        // Retour de la vue du formulaire d'édition
        return view('dashboard.editRevendeur', compact('revendeur'));
    }

    /**
     * Met à jour un revendeur existant.
     * Valide les données et met à jour le revendeur.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Récupération du revendeur
        $revendeur = Revendeur::findOrFail($id);

        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:revendeurs,email,' . $id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'statut' => 'required|in:actif,inactif,suspendu',
        ]);

        // Mise à jour du revendeur
        $revendeur->update($validated);

        // Redirection avec message de succès
        return redirect()->route('revendeurs.index')->with('success', 'Revendeur mis à jour avec succès.');
    }

    /**
     * Supprime un revendeur de la base de données.
     * Vérifie d'abord qu'il n'a pas de tickets ou commandes actives.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Récupération du revendeur
        $revendeur = Revendeur::findOrFail($id);

        // Vérification des contraintes (tickets ou commandes actives)
        if ($revendeur->tickets()->where('statut', 'vendu')->exists() ||
            $revendeur->commandes()->where('statut', '!=', 'livree')->exists()) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce revendeur car il a des tickets ou commandes actives.');
        }

        // Suppression du revendeur
        $revendeur->delete();

        // Redirection avec message de succès
        return redirect()->route('revendeurs.index')->with('success', 'Revendeur supprimé avec succès.');
    }

    /**
     * Change le statut d'un revendeur.
     * Permet d'activer, désactiver ou suspendre un revendeur.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changerStatut(Request $request, $id)
    {
        // Récupération du revendeur
        $revendeur = Revendeur::findOrFail($id);

        // Validation du statut
        $request->validate([
            'statut' => 'required|in:actif,inactif,suspendu',
        ]);

        // Mise à jour du statut
        $revendeur->update(['statut' => $request->statut]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Statut du revendeur mis à jour avec succès.');
    }
}
