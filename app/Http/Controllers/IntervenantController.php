<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\IntervenantRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;

class IntervenantController extends Controller
{
    /**
     * LISTE DES INTERVENANTS
     */
    public function index(Request $request)
    {
        $intervenants = Intervenant::withCount('votes')
            ->latest()
            ->paginate(10);

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
        dd($request->all());
        $data = $request->validated();
        $data['statut'] = 'en-attente';
        $data['vote_actif'] = $request->has('vote_actif');

        // Upload fichiers
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('intervenants', 'public');
        }
        if ($request->hasFile('paroles_classiques')) {
            $data['paroles_classiques'] = $request->file('paroles_classiques')->store('paroles', 'public');
        }
        if ($request->hasFile('paroles_hits')) {
            $data['paroles_hits'] = $request->file('paroles_hits')->store('paroles', 'public');
        }

        Intervenant::create($data);

        return redirect()->route('dashboard.intervenants')->with('success', 'Intervenant enregistré avec succès');
    }

    /**
     * DÉTAIL D'UN INTERVENANT
     */
    public function show(Intervenant $intervenant)
    {
        $votesByOption = $intervenant->votes()
            ->get()
            ->groupBy('type')
            ->map(fn($group) => $group->count())
            ->toArray();

        $votesByOption = array_merge([
            'Classique' => 0,
            'Hits' => 0
        ], $votesByOption);

        $colors = [
            'Classique' => '#ff6b35',
            'Hits' => '#4dabf7',
        ];

        $options = [
            ['name' => 'Classique', 'file' => 'PDF de paroles', 'icon' => 'fas fa-download'],
            ['name' => 'Hits', 'file' => 'PDF de paroles', 'icon' => 'fas fa-music']
        ];

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
            'vote_actif' => 'nullable|boolean',
            'photo'  => 'nullable|image|max:2048',
            'date_debut' => 'nullable|date',
            'heure_debut' => 'nullable',
        ]);

        $data['vote_actif'] = $request->has('vote_actif');

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
        // Supprimer fichiers
        foreach (['photo', 'paroles_classiques', 'paroles_hits'] as $file) {
            if ($intervenant->$file && Storage::disk('public')->exists($intervenant->$file)) {
                Storage::disk('public')->delete($intervenant->$file);
            }
        }

        $intervenant->delete();

        return back()->with('success', 'Intervenant supprimé avec succès');
    }

    /**
     * RECHERCHE AJAX
     */
    public function search(Request $request)
    {
        $query = Intervenant::query()->withCount('votes');

        // Recherche texte
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nom', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%");
            });
        }

        // Filtre rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filtre intervalle
        if ($request->filled('interval')) {
            switch ($request->interval) {
                case 'jour':
                    $query->whereDate('date_debut', Carbon::today());
                    break;
                case 'semaine':
                    $query->whereBetween('date_debut', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'mois':
                    $query->whereMonth('date_debut', Carbon::now()->month)
                          ->whereYear('date_debut', Carbon::now()->year);
                    break;
            }
        }

        $intervenants = $query->limit(50)->get()->map(function($intervenant) {
            $intervenant->photo_url = $intervenant->photo 
                ? asset('storage/' . $intervenant->photo) 
                : 'https://i.pravatar.cc/150';
            $intervenant->date_debut = optional($intervenant->date_debut)->format('d M Y');
            $intervenant->heure_debut = $intervenant->heure_debut 
                ? Carbon::parse($intervenant->heure_debut)->format('H:i') 
                : '-';
            return $intervenant;
        });

        return response()->json($intervenants);
    }
}
