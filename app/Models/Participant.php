<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'billet_id',
        'nom',
        'email',
        'paiement_confirme',
        'transaction_id',
        'code_acces',
        'statut',
        'premiere_connexion',
    ];

    public function billet()
    {
        return $this->belongsTo(Billet::class);
    }
}
