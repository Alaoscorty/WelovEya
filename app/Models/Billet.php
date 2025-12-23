<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    use HasFactory;

    /**
     * Les champs modifiables en masse
     */
    protected $fillable = [
        'nom',
        'description',
        'prix_vente',
        'billets_vendus',
        'ventes_max',
        'date_evenement',
        'statut',
    ];

    /**
     * Valeurs par défaut
     */
    protected $attributes = [
        'billets_vendus' => 0,
        'statut' => 'actif',
    ];

    /**
     * Cast des champs
     */
    protected $casts = [
        'prix_vente' => 'float',
        'billets_vendus' => 'integer',
        'ventes_max' => 'integer',
        'date_evenement' => 'datetime',
    ];

    /**
     * 🔹 Revenu généré par ce billet
     */
    public function getRevenuAttribute()
    {
        return $this->prix_vente * $this->billets_vendus;
    }

    /**
     * 🔹 Taux de remplissage (%) du billet
     */
    public function getTauxRemplissageAttribute()
    {
        if ($this->ventes_max === 0) {
            return 0;
        }

        return round(($this->billets_vendus / $this->ventes_max) * 100, 1);
    }
    public function participants()
{
    return $this->hasMany(Participant::class);
}

}
