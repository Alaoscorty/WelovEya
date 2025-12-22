<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();

        return view('dashboard.articles', [
            'produits' => $produits,
            'totalArticles' => $produits->count(),
            'stockTotal' => $produits->sum('stock'),
            'revenusGeneres' => $produits->sum(fn($p) => $p->prix * $p->stock),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nom' => 'required|string',
                'prix' => 'required|numeric',
                'categorie' => 'required|string',
                'description' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }

        $produit = Produit::create($data + ['stock' => 0]);

        return response()->json([
            'success' => true,
            'produit' => $produit
        ]);
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return back();
    }
}
