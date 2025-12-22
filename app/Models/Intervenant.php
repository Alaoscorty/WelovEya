<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- IMPORTANT

class Intervenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'region',
        'pays',
        'date_debut',
        'jour_evenement',
        'heure_debut',
        'heure_fin',
        'photo',
        'vote_actif',
        'date_limite_vote',
        'code',
        'statut',
        'paroles_classiques',
        'paroles_hits',
    ];

    protected static function booted()
    {
        static::creating(function ($intervenant) {
            // Générer le code uniquement si vide
            if (empty($intervenant->code)) {
                $intervenant->code = 'INT-' . strtoupper(Str::random(6));
            }
        });
    }

    protected $casts = [
        'vote_actif' => 'boolean',
        'date_debut' => 'date',
        'date_limite_vote' => 'date',
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
    ];

    protected $attributes = [
        'vote_actif' => false,
        'statut' => 'en-attente', // <-- attention au tiret
    ];

    // ✅ Relation avec les votes
    public function votes()
    {
        return $this->hasMany(Vote::class); 
    }

    public function votesActifs()
    {
        return $this->votes()->where('actif', true);
    }
}
