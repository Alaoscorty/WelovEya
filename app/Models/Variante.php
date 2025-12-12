<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une variante d'article dans le système.
 * Une variante peut être une taille, une couleur, etc., pour un article donné.
 */
class Variante extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_id', // ID de l'article parent
        'nom', // Nom de la variante (ex: "Taille S", "Couleur Bleu")
        'valeur', // Valeur spécifique de la variante (ex: "S", "Bleu")
        'stock', // Stock disponible pour cette variante
        'prix_supplementaire', // Prix supplémentaire pour cette variante (optionnel)
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, le stock et le prix supplémentaire sont castés en entier et décimal respectivement.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'stock' => 'integer',
        'prix_supplementaire' => 'decimal:2',
    ];

    /**
     * Relation avec l'article parent.
     * Chaque variante appartient à un article spécifique.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Méthode pour vérifier si la variante est en stock.
     * Une variante est en stock si son stock est supérieur à 0.
     *
     * @return bool
     */
    public function estEnStock()
    {
        return $this->stock > 0;
    }

    /**
     * Méthode pour obtenir le prix total de la variante.
     * Le prix total est le prix de l'article plus le prix supplémentaire de la variante.
     *
     * @return float
     */
    public function getPrixTotalAttribute()
    {
        return $this->article->prix_vente + ($this->prix_supplementaire ?? 0);
    }
}
