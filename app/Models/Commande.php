<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une commande dans le système.
 * Une commande contient plusieurs articles avec leurs quantités et prix.
 */
class Commande extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero_commande', // Numéro unique de la commande
        'client_nom', // Nom du client
        'client_email', // Email du client
        'client_telephone', // Téléphone du client
        'statut', // Statut de la commande (En attente, Confirmée, Expédiée, etc.)
        'total', // Montant total de la commande
        'date_commande', // Date de la commande
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, le total est casté en décimal pour la précision monétaire.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => 'decimal:2',
        'date_commande' => 'datetime',
    ];

    /**
     * Relation avec les articles de la commande.
     * Une commande peut contenir plusieurs articles avec des quantités spécifiques.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class)->withPivot('quantite', 'prix_unitaire');
    }

    /**
     * Méthode pour calculer le total de la commande.
     * Le total est recalculé en fonction des articles et de leurs quantités.
     *
     * @return float
     */
    public function calculerTotal()
    {
        $total = 0;
        foreach ($this->articles as $article) {
            $total += $article->pivot->quantite * $article->pivot->prix_unitaire;
        }
        return $total;
    }

    /**
     * Méthode pour obtenir le statut formaté.
     * Retourne une chaîne de caractères représentant le statut de la commande.
     *
     * @return string
     */
    public function getStatutFormateAttribute()
    {
        switch ($this->statut) {
            case 'en_attente':
                return 'En attente';
            case 'confirmee':
                return 'Confirmée';
            case 'expediee':
                return 'Expédiée';
            case 'livree':
                return 'Livrée';
            default:
                return 'Inconnu';
        }
    }
}
