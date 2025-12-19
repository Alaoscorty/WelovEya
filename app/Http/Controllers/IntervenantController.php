<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\IntervenantRequest;
use Illuminate\Support\Str;

class IntervenantController extends Controller
{
    /**
     * LISTE DES INTERVENANTS
     */
    public function index(Request $request)
    {
        $query = Intervenant::query();

        // Recherche par texte
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($subQuery) use ($q) {
                $subQuery->where('nom', 'like', "%{$q}%")
                         ->orWhere('email', 'like', "%{$q}%")
                         ->orWhere('code', 'like', "%{$q}%");
            });
        }

        // Filtre par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $intervenants = $query->latest()->paginate(10);

        // Statistiques pour les cartes
        $stats = [
            'artistes'   => Intervenant::where('role', 'artiste')->count(),
            'animateurs' => Intervenant::where('role', 'animateur')->count(),
            'djs'        => Intervenant::where('role', 'dj')->count(),
        ];

        return view('dashboard.intervenants', compact('intervenants', 'stats'));
    }

    /**
     * FORMULAIRE AJOUT
     */
    public function create()
    {
        return view('dashboard.intervenants.create');
    }

    /**
     * ENREGISTREMENT
     */
    public function store(IntervenantRequest $request)
    {
        $data = $request->validated();

        $data['code'] = 'INT-' . strtoupper(Str::random(6));
        $data['statut'] = 'en-attente';
        $data['vote_actif'] = $request->has('vote_actif');

        // Upload photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('intervenants', 'public');
        }

        Intervenant::create($data);

        return redirect()->route('dashboard.intervenants')->with('success', 'Intervenant enregistré avec succès');
    }

    /**
     * DÉTAIL D'UN INTERVENANT
     */
    public function show(Intervenant $intervenant)
{
    // Récupérer tous les votes de l'intervenant
    $votes = $intervenant->votes()->get();

    // Comptage des votes par type
    $votesByOption = $votes->groupBy('type')->map(function($group) {
        return $group->count();
    })->toArray();

    // Si aucune catégorie, initialiser à 0
    $votesByOption = array_merge([
        'Classique' => 0,
        'Hits' => 0
    ], $votesByOption);

    // Couleurs pour graphiques
    $colors = [
        'Classique' => '#ff6b35',
        'Hits' => '#4dabf7',
    ];

    // Options pour les fiches de paroles
    $options = [
        [
            'name' => 'Classique',
            'file' => 'PDF de paroles',
            'icon' => 'fas fa-download'
        ],
        [
            'name' => 'Hits',
            'file' => 'PDF de paroles',
            'icon' => 'fas fa-music'
        ]
    ];

    // Déterminer l'option gagnante
    $winningOption = collect($votesByOption)->sortDesc()->keys()->first() ?? 'Classique';

    return view('dashboard.intervenants.show', compact(
        'intervenant',
        'votesByOption',
        'colors',
        'options',
        'winningOption'
    ));
}

    /**
     * FORMULAIRE ÉDITION
     */
    public function edit(Intervenant $intervenant)
    {
        return view('dashboard.intervenants.edit', compact('intervenant'));
    }

    /**
     * MISE À JOUR
     */
    public function update(Request $request, Intervenant $intervenant)
    {
        $data = $request->validate([
            'nom'    => 'required|string|max:255',
            'email'  => 'required|email|unique:intervenants,email,' . $intervenant->id,
            'role'   => 'required|in:artiste,animateur,dj',
            'statut' => 'required|in:en-attente,confirme',
            'photo'  => 'nullable|image|max:2048',
            'date_debut' => 'nullable|date',
            'heure_debut' => 'nullable',

        ]);

        // Nouvelle photo ?
        if ($request->hasFile('photo')) {
            if ($intervenant->photo && Storage::disk('public')->exists($intervenant->photo)) {
                Storage::disk('public')->delete($intervenant->photo);
            }

            $data['photo'] = $request->file('photo')->store('intervenants', 'public');
        }

        $intervenant->update($data);

        return redirect()->route('dashboard.intervenants')->with('success', 'Intervenant modifié avec succès');
    }

    /**
     * SUPPRESSION
     */
    public function destroy(Intervenant $intervenant)
    {
        if ($intervenant->photo && Storage::disk('public')->exists($intervenant->photo)) {
            Storage::disk('public')->delete($intervenant->photo);
        }

        $intervenant->delete();

        return back()->with('success', 'Intervenant supprimé avec succès');
    }

    /**
     * RECHERCHE AJAX
     */
    public function search(Request $request)
    {
        $query = Intervenant::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('nom', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('code', 'like', "%{$q}%");
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        return response()->json($query->limit(10)->get());
    }
}
