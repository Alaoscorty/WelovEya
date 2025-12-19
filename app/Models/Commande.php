<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_acheteur', 'email', 'telephone', 'date_commande',
        'statut', 'methode_paiement', 'total'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
