<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntervenantController extends Controller
{
    /**
     * LISTE DES INTERVENANTS (Dashboard)
     */
   public function index()
{
    // Récupérer les intervenants avec le nombre de votes
    $intervenants = Intervenant::withCount('votes')->get(); // votes = relation vers table votes

    return view('dashboard.intervenants', compact('intervenants'));
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
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:intervenants,email',
            'role' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $intervenant = new Intervenant();
        $intervenant->nom = $request->nom;
        $intervenant->email = $request->email;
        $intervenant->role = $request->role;

        if ($request->hasFile('photo')) {
            $intervenant->photo = $request->file('photo')->store('intervenants', 'public');
        }

        $intervenant->statut = 'en_attente';
        $intervenant->save();

        return redirect()->route('dashboard.intervenants')->with('success', 'Intervenant ajouté avec succès !');
    }
    /**
     * DÉTAIL
     */
    public function show(Intervenant $intervenant)
{
    // Calcul des stats pour les charts
    $votes_classiques = $intervenant->votes()->where('type', 'classique')->count();
    $votes_hits = $intervenant->votes()->where('type', 'hits')->count();

    $stats = [
        'votes_classiques' => $votes_classiques,
        'votes_hits' => $votes_hits,
    ];

    return view('dashboard.detailIntervenant', compact('intervenant', 'stats'));
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
            'statut' => 'required|in:en_attente,confirme',
            'heure'  => 'required',
            'date'   => 'required|date',
            'photo'  => 'nullable|image|max:2048',
        ]);

        // Nouvelle photo ?
        if ($request->hasFile('photo')) {

            // Supprimer l’ancienne
            if ($intervenant->photo && Storage::disk('public')->exists($intervenant->photo)) {
                Storage::disk('public')->delete($intervenant->photo);
            }

            $data['photo'] = $request->file('photo')
                ->store('intervenants', 'public');
        }

        $intervenant->update($data);

        return redirect()
            ->route('dashboard.intervenants')
            ->with('success', 'Intervenant modifié avec succès');
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

        return back()->with('success', 'Intervenant supprimé');
    }

    /**
     * RECHERCHE AJAX
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        return Intervenant::where('nom', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->limit(10)
            ->get();
    }
}
