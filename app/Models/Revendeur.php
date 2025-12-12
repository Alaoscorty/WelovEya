<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant un revendeur dans le système.
 * Un revendeur est une personne ou une entité qui vend des tickets ou des articles.
 */
class Revendeur extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom', // Nom du revendeur
        'prenom', // Prénom du revendeur
        'email', // Adresse email du revendeur
        'telephone', // Numéro de téléphone du revendeur
        'adresse', // Adresse physique du revendeur
        'statut', // Statut du revendeur (Actif, Inactif, Suspendu)
        'date_inscription', // Date d'inscription du revendeur
        'ventes_totales', // Montant total des ventes réalisées
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, la date d'inscription est castée en datetime et les ventes totales en décimal.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_inscription' => 'datetime',
        'ventes_totales' => 'decimal:2',
    ];

    /**
     * Relation avec les tickets vendus par le revendeur.
     * Un revendeur peut vendre plusieurs tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Relation avec les commandes gérées par le revendeur.
     * Un revendeur peut gérer plusieurs commandes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    /**
     * Méthode pour obtenir le nom complet du revendeur.
     * Concatène le prénom et le nom.
     *
     * @return string
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Méthode pour vérifier si le revendeur est actif.
     * Un revendeur est considéré actif si son statut est 'actif'.
     *
     * @return bool
     */
    public function estActif()
    {
        return $this->statut === 'actif';
    }

    /**
     * Méthode pour calculer les ventes totales du revendeur.
     * Calcule le total des ventes basées sur les tickets et commandes.
     *
     * @return float
     */
    public function calculerVentesTotales()
    {
        $ventesTickets = $this->tickets->sum('prix');
        $ventesCommandes = $this->commandes->sum('total');
        return $ventesTickets + $ventesCommandes;
    }
}
