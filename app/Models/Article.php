<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant un article dans le système.
 * Ce modèle gère les informations de base des articles comme le nom, le prix, la catégorie, etc.
 */
class Article extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_article', // Identifiant unique de l'article
        'nom', // Nom de l'article
        'prix_vente', // Prix de vente en FCFA
        'categorie', // Catégorie de l'article (Vêtement, Accessoire, etc.)
        'description', // Description détaillée de l'article
        'statut', // Statut de l'article (Disponible, Épuisé, Stock bas)
        'stock_global', // Stock total disponible
        'nombre_variantes', // Nombre de variantes disponibles
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, le prix est casté en entier pour éviter les problèmes de précision.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prix_vente' => 'integer',
        'stock_global' => 'integer',
        'nombre_variantes' => 'integer',
    ];

    /**
     * Relation avec les variantes d'articles.
     * Un article peut avoir plusieurs variantes (tailles, couleurs, etc.).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantes()
    {
        return $this->hasMany(Variante::class);
    }

    /**
     * Relation avec les commandes.
     * Un article peut être présent dans plusieurs commandes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function commandes()
    {
        return $this->belongsToMany(Commande::class)->withPivot('quantite', 'prix_unitaire');
    }

    /**
     * Méthode pour vérifier si l'article est disponible.
     * Un article est considéré disponible si son stock global est supérieur à 0.
     *
     * @return bool
     */
    public function estDisponible()
    {
        return $this->stock_global > 0;
    }

    /**
     * Méthode pour obtenir le statut formaté.
     * Retourne une chaîne de caractères représentant le statut de l'article.
     *
     * @return string
     */
    public function getStatutFormateAttribute()
    {
        switch ($this->statut) {
            case 'disponible':
                return 'Disponible';
            case 'epuise':
                return 'Épuisé';
            case 'stock_bas':
                return 'Stock bas';
            default:
                return 'Inconnu';
        }
    }
}
