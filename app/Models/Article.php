<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'articles';

    // Colonnes assignables en masse
    protected $fillable = [
        'commande_id',
        'nom_article',
        'type_article',
        'prix_unitaire',
        'quantite',
        'total',
    ];

    // Calcul automatique du total avant sauvegarde
    protected static function booted()
    {
        static::creating(function ($article) {
            $article->total = $article->prix_unitaire * $article->quantite;
        });
    }

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
