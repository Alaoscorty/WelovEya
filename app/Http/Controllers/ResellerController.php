<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseller;

class ResellerController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
            'date_adhesion' => 'nullable|date',
            'statut' => 'nullable|string',
            'commission_standard' => 'nullable|numeric',
            'commission_premium' => 'nullable|numeric',
            'commission_vip' => 'nullable|numeric',
            'commission_elite' => 'nullable|numeric',
            'stock_standard' => 'nullable|numeric',
            'stock_premium' => 'nullable|numeric',
            'stock_vip' => 'nullable|numeric',
            'stock_elite' => 'nullable|numeric',
        ]);

        // Création du revendeur
        Reseller::create($validated);

        // Retourne une réponse JSON
        return response()->json(['success' => true]);
    }

    public function index()
    {
        // Liste des revendeurs
        $revendeurs = Reseller::all();
        return view('revendeurs.index', compact('revendeurs'));
    }
}
