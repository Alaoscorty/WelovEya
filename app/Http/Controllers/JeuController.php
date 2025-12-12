<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use App\Models\ParticipationJeu;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les opérations CRUD sur les jeux concours.
 * Ce contrôleur permet de créer, lire, mettre à jour et supprimer des jeux.
 */
class JeuController extends Controller
{
    /**
     * Affiche la liste des jeux.
     * Redirige vers le contrôleur DashboardController pour l'affichage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Redirection vers la méthode jeux du DashboardController
        return app(DashboardController::class)->jeux($request);
    }

    /**
     * Affiche le formulaire de création d'un nouveau jeu.
     * Prépare les données nécessaires pour le formulaire.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retour de la vue du formulaire de création
        return view('dashboard.ajoutJeux');
    }

    /**
     * Stocke un nouveau jeu en base de données.
     * Valide les données et crée le jeu.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date|after:now',
            'date_fin' => 'required|date|after:date_debut',
            'prix_par_participation' => 'required|numeric|min:0',
            'nombre_gagnants' => 'required|integer|min:1',
            'lots' => 'required|string',
            'statut' => 'required|in:actif,inactif,termine',
        ]);

        // Création du jeu
        Jeu::create($validated);

        // Redirection avec message de succès
        return redirect()->route('jeux.index')->with('success', 'Jeu créé avec succès.');
    }

    /**
     * Affiche les détails d'un jeu spécifique.
     * Récupère le jeu avec ses participations.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupération du jeu avec ses participations
        $jeu = Jeu::with('participations')->findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailJeu', compact('jeu'));
    }

    /**
     * Affiche le formulaire d'édition d'un jeu.
     * Prépare les données du jeu pour l'édition.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupération du jeu
        $jeu = Jeu::findOrFail($id);

        // Retour de la vue du formulaire d'édition
        return view('dashboard.editJeu', compact('jeu'));
    }

    /**
     * Met à jour un jeu existant.
     * Valide les données et met à jour le jeu.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Récupération du jeu
        $jeu = Jeu::findOrFail($id);

        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'prix_par_participation' => 'required|numeric|min:0',
            'nombre_gagnants' => 'required|integer|min:1',
            'lots' => 'required|string',
            'statut' => 'required|in:actif,inactif,termine',
        ]);

        // Mise à jour du jeu
        $jeu->update($validated);

        // Redirection avec message de succès
        return redirect()->route('jeux.index')->with('success', 'Jeu mis à jour avec succès.');
    }

    /**
     * Supprime un jeu de la base de données.
     * Vérifie d'abord qu'il n'y a pas de participations.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Récupération du jeu
        $jeu = Jeu::findOrFail($id);

        // Vérification des contraintes (participations existantes)
        if ($jeu->participations()->exists()) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce jeu car il y a des participations.');
        }

        // Suppression du jeu
        $jeu->delete();

        // Redirection avec message de succès
        return redirect()->route('jeux.index')->with('success', 'Jeu supprimé avec succès.');
    }

    /**
     * Tire au sort les gagnants d'un jeu.
     * Sélectionne aléatoirement les gagnants parmi les participants.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tirerGagnants($id)
    {
        // Récupération du jeu
        $jeu = Jeu::with('participations')->findOrFail($id);

        // Vérification que le jeu est terminé
        if ($jeu->statut !== 'termine') {
            return redirect()->back()->with('error', 'Le jeu doit être terminé pour tirer les gagnants.');
        }

        // Récupération des participations
        $participations = $jeu->participations;

        // Vérification qu'il y a suffisamment de participants
        if ($participations->count() < $jeu->nombre_gagnants) {
            return redirect()->back()->with('error', 'Pas assez de participants pour tirer ' . $jeu->nombre_gagnants . ' gagnants.');
        }

        // Sélection aléatoire des gagnants
        $gagnants = $participations->random($jeu->nombre_gagnants);

        // Mise à jour des participations gagnantes
        foreach ($gagnants as $gagnant) {
            $gagnant->update(['est_gagnant' => true]);
        }

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Gagnants tirés au sort avec succès.');
    }

    /**
     * Enregistre une participation à un jeu.
     * Crée une nouvelle participation pour un utilisateur.
     *
     * @param Request $request
     * @param int $jeuId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function participer(Request $request, $jeuId)
    {
        // Récupération du jeu
        $jeu = Jeu::findOrFail($jeuId);

        // Vérification que le jeu est actif
        if ($jeu->statut !== 'actif') {
            return redirect()->back()->with('error', 'Ce jeu n\'est pas actif.');
        }

        // Validation des données
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Vérification que l'utilisateur n'a pas déjà participé
        if (ParticipationJeu::where('jeu_id', $jeuId)->where('user_id', $request->user_id)->exists()) {
            return redirect()->back()->with('error', 'Cet utilisateur a déjà participé à ce jeu.');
        }

        // Création de la participation
        ParticipationJeu::create([
            'jeu_id' => $jeuId,
            'user_id' => $request->user_id,
            'date_participation' => now(),
            'est_gagnant' => false,
        ]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Participation enregistrée avec succès.');
    }
}
