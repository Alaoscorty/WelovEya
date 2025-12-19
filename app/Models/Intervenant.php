<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nom',
        'email',
        'telephone',
        'region',
        'pays',
        'date_debut',
        'jour_evenement',
        'heure_debut',
        'heure_fin',
        'role',
        'statut',
        'photo',
        'vote_actif',
    ];

    protected $casts = [
        'vote_actif' => 'boolean',
        'date_debut' => 'date',
        'heure_debut' => 'datetime:H:i',
    ];
    

    // ✅ Relation avec les votes
    public function votes()
    {
        return $this->hasMany(Vote::class); // Assure-toi que Vote::class existe
    }
    
}
