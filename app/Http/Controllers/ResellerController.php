<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseller;
use Carbon\Carbon;
class ResellerController extends Controller
{
    // Affichage du tableau
    

public function index()
{
    // Liste des revendeurs
    $revendeurs = Reseller::all();

    // Total des revendeurs
    $totalRevendeurs = $revendeurs->count();

    // Revendeurs actifs ce mois
    $actifsCeMois = Reseller::where('statut', 'ACTIF')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

    // Commission moyenne
    $commissionMoyenne = Reseller::selectRaw('
        (AVG(commission_standard) +
         AVG(commission_premium) +
         AVG(commission_vip) +
         AVG(commission_elite)) / 4 as moyenne
    ')->value('moyenne');

    return view('dashboard.revendeur', compact(
        'revendeurs',
        'totalRevendeurs',
        'actifsCeMois',
        'commissionMoyenne'
    ));
}



    // Création d'un revendeur
    public function store(Request $request)
    {
        $revendeur = Reseller::create([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'date_adhesion' => $request->date_adhesion,
            'statut' => $request->statut,
            'commission_standard' => $request->commission_standard,
            'commission_premium' => $request->commission_premium,
            'commission_vip' => $request->commission_vip,
            'commission_elite' => $request->commission_elite,
            'stock_standard' => $request->stock_standard,
            'stock_premium' => $request->stock_premium,
            'stock_vip' => $request->stock_vip,
            'stock_elite' => $request->stock_elite,
        ]);

        return redirect()
    ->route('resellers.index')
    ->with('success', 'Revendeur créé avec succès');

    }
}
