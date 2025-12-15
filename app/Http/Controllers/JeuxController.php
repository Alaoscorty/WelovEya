<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jeu;

class JeuxController extends Controller
{
    // Affiche la liste des jeux
    public function index()
    {
        $jeux = Jeu::orderBy('date_debut', 'desc')->get();
        return view('dashboard.Jeux', compact('jeux'));
    }

    // Affiche le formulaire de création ou d'édition
    public function create()
    {
        return view('dashboard.ajoutJeux'); // Pour création
    }

    public function edit(Jeu $jeu)
    {
        return view('dashboard.ajoutJeux', compact('jeu')); // Pour édition
    }

    // Stocke un nouveau jeu
    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        Jeu::create($validated);

        return redirect()->route('suivi_jeux')->with('success', 'Jeu-concours créé avec succès !');
    }

    // Met à jour un jeu existant
    public function update(Request $request, Jeu $jeu)
    {
        $validated = $this->validateData($request);
        $jeu->update($validated);

        return redirect()->route('suivi_jeux')->with('success', 'Jeu modifié avec succès !');
    }

    // Supprime un jeu
    public function destroy(Jeu $jeu)
    {
        $jeu->delete();
        return redirect()->route('suivi_jeux')->with('success', 'Jeu supprimé avec succès !');
    }

    // Validation commune
    protected function validateData(Request $request)
    {
        return $request->validate([
            'nom_du_jeu' => 'required|string|max:255',
            'description' => 'required|string',
            'partenaire' => 'required|string|max:255',
            'type_de_jeu' => 'required|string|max:100',
            'reseau_social' => 'required|string|max:50',
            'lien' => 'required|url',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'recompense' => 'required|string|max:255',
            'nombre_gagnants' => 'required|integer|min:1',
        ]);
    }
}
