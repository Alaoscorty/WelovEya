<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use Illuminate\Http\Request;
use PDF;

class BilletController extends Controller
{
    public function index()
    {
        $billets = Billet::paginate(10);
        $revenusTotaux = $billets->sum(fn($billet) => $billet->prix_vente * $billet->billets_vendus);
        $totalBilletsVendus = $billets->sum('billets_vendus');
        $tauxRemplissage = $billets->count() > 0 
            ? round(($totalBilletsVendus / $billets->sum('ventes_max')) * 100, 1) 
            : 0;

        return view('dashboard.billets-streaming', compact('billets', 'revenusTotaux', 'totalBilletsVendus', 'tauxRemplissage'));

    }

    public function updateMaxVentes(Request $request, Billet $billet)
    {
        $request->validate([
            'ventes_max' => 'required|integer|min:1',
        ]);

        $billet->ventes_max = $request->ventes_max;
        $billet->save();

        return redirect()->route('billets.index')->with('success', 'Ventes max mises à jour !');
    }

    // Méthodes pour voir participants ou éditer billet
    public function participants(Billet $billet)
    {   
        $participants = $billet->participants()->paginate(10);
        // Récupérer les participants liés au billet

        return view('dashboard.participants', compact('billet', 'participants'));
    }


    public function edit(Billet $billet)
{
    return view('dashboard.edit_billet', compact('billet'));
}

public function update(Request $request, Billet $billet)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string',
        'prix_vente' => 'required|numeric|min:0',
        'ventes_max' => 'required|integer|min:1',
        'date_evenement' => 'nullable|date',
        'description' => 'nullable|string',
    ]);

    $billet->update($request->only(['nom', 'type', 'prix_vente', 'ventes_max', 'date_evenement', 'description']));

    return redirect()->route('billets.index')->with('success', 'Billet mis à jour avec succès !');
}

    public function create() {
    return view('dashboard.creer_billet');
}

public function store(Request $request) {
    $request->validate([
        'nom' => 'required|string|max:255',
        'prix_vente' => 'required|numeric|min:0',
        'ventes_max' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'date_evenement' => 'nullable|date',
    ]);

    Billet::create($request->all());

    return redirect()->route('billets.index')->with('success', 'Billet créé avec succès !');
}
public function exportPDF(Billet $billet)
{
    // Charger la vue du ticket avec les données
    $pdf = PDF::loadView('dashboard.ticket_pdf', compact('billet'));
    
    // Afficher dans le navigateur (stream)/ download pour un téléchargement direct
    return $pdf->download("billet_{$billet->id}.pdf");

}
}
