<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Article;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('articles')->orderBy('id','desc')->get();
        return view('dashboard.commandes', compact('commandes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_acheteur' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'date_commande' => 'required|date',
            'statut' => 'required',
            'methode_paiement' => 'required',
            'articles_data' => 'required|json'
        ]);

        $articlesData = json_decode($request->articles_data, true);

        $total = 0;
        foreach($articlesData as $art){
            $total += $art['prix'] * $art['quantite'];
        }

        $commande = Commande::create([
            'nom_acheteur' => $request->nom_acheteur,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'date_commande' => $request->date_commande,
            'statut' => $request->statut,
            'methode_paiement' => $request->methode_paiement,
            'total' => $total
        ]);

        foreach($articlesData as $art){
            $commande->articles()->create($art);
        }

        return redirect()->back()->with('success', 'Commande créée avec succès!');
    }
}
