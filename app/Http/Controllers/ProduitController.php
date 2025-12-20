<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();

        $totalArticles = $produits->count();
        $stockTotal = $produits->sum('stock');
        $revenusGeneres = $produits->sum(function($produit){
            return $produit->prix * $produit->stock;
        });

        return view('dashboard.articles', compact('produits', 'totalArticles', 'stockTotal', 'revenusGeneres'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        // Création du produit et assignation à une variable
        $produit = Produit::create([
            'nom' => $request->name,
            'prix' => $request->price,
            'categorie' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock ?? 0, // valeur par défaut si stock non fourni
        ]);

        // Retourne le produit créé pour AJAX
        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté avec succès !',
            'produit' => $produit
        ]);
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('dashboard.articles')->with('success', 'Produit supprimé avec succès');
    }
}
