<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    /**
     * Affiche la liste de toutes les actions
     */
    public function index()
    {
        $actions = Action::orderBy('date_time')->get();
        return view('dashboard.activites', compact('actions'));
    }

    /**
     * Affiche le formulaire de création d'une action
     */
    public function create()
    {
        return view('actions.create'); // Crée la page create.blade.php
    }

    /**
     * Enregistre une nouvelle action en base de données
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'date_time'   => 'required|date',
            'duration'    => 'required|string',
            'slots'       => 'required|integer|min:1',
            'reward'      => 'required|string',
        ]);

        Action::create($validated);

        return redirect()
            ->route('dashboard.activites')
            ->with('success', 'Action créée avec succès !');
    }

    /**
     * Affiche les détails d'une action
     */
    public function show(Action $action)
    {
        return view('actions.show', compact('action'));
    }

    /**
     * Affiche le formulaire d'édition d'une action
     */
    public function edit(Action $action)
    {
        return view('actions.edit', compact('action'));
    }

    /**
     * Met à jour une action existante
     */
    public function update(Request $request, Action $action)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'date_time'   => 'required|date',
            'duration'    => 'required|string',
            'slots'       => 'required|integer|min:1',
            'reward'      => 'required|string',
        ]);

        $action->update($validated);

        return redirect()
            ->route('dashboard.activites')
            ->with('success', 'Action mise à jour avec succès !');
    }

    public function destroy(Action $action)
    {
        $action->delete();

        return redirect()
            ->route('dashboard.activites')
            ->with('success', 'Action supprimée avec succès !');
    }
}
