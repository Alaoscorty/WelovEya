<?php

namespace App\Http\Controllers;

use App\Models\Plainte;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les opérations CRUD sur les plaintes.
 * Ce contrôleur permet de créer, lire, mettre à jour et supprimer des plaintes.
 */
class PlainteController extends Controller
{
    /**
     * Affiche la liste des plaintes.
     * Redirige vers le contrôleur DashboardController pour l'affichage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Redirection vers la méthode plaintes du DashboardController
        return app(DashboardController::class)->plaintes($request);
    }

    /**
     * Affiche les détails d'une plainte spécifique.
     * Récupère la plainte avec ses informations.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupération de la plainte
        $plainte = Plainte::findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailPlainte', compact('plainte'));
    }

    /**
     * Met à jour le statut d'une plainte.
     * Permet de changer le statut (en_attente, en_cours, resolue, rejetee).
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatut(Request $request, $id)
    {
        // Récupération de la plainte
        $plainte = Plainte::findOrFail($id);

        // Validation du statut
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,resolue,rejetee',
        ]);

        // Mise à jour du statut
        $plainte->update(['statut' => $request->statut]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Statut de la plainte mis à jour avec succès.');
    }

    /**
     * Supprime une plainte de la base de données.
     * Vérifie d'abord que la plainte n'est pas résolue.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Récupération de la plainte
        $plainte = Plainte::findOrFail($id);

        // Vérification du statut (ne pas supprimer si résolue)
        if ($plainte->statut === 'resolue') {
            return redirect()->back()->with('error', 'Impossible de supprimer une plainte résolue.');
        }

        // Suppression de la plainte
        $plainte->delete();

        // Redirection avec message de succès
        return redirect()->route('plaintes.index')->with('success', 'Plainte supprimée avec succès.');
    }

    /**
     * Ajoute une réponse à une plainte.
     * Permet à l'administrateur de répondre à la plainte.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function repondre(Request $request, $id)
    {
        // Récupération de la plainte
        $plainte = Plainte::findOrFail($id);

        // Validation de la réponse
        $request->validate([
            'reponse' => 'required|string',
        ]);

        // Mise à jour de la réponse et du statut
        $plainte->update([
            'reponse' => $request->reponse,
            'date_reponse' => now(),
            'statut' => 'resolue',
        ]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Réponse ajoutée avec succès.');
    }
}
