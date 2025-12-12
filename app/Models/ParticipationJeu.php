<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une participation à un jeu dans le système.
 * Une participation lie un utilisateur à un jeu spécifique.
 */
class ParticipationJeu extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jeu_id', // ID du jeu
        'user_id', // ID de l'utilisateur participant
        'date_participation', // Date de la participation
        'numero_ticket', // Numéro de ticket attribué pour la participation
        'gagnant', // Indique si l'utilisateur a gagné (true/false)
        'prix_gagne', // Montant gagné si l'utilisateur est gagnant
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, la date de participation est castée en datetime, gagnant en booléen et prix gagné en décimal.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_participation' => 'datetime',
        'gagnant' => 'boolean',
        'prix_gagne' => 'decimal:2',
    ];

    /**
     * Relation avec le jeu.
     * Chaque participation appartient à un jeu spécifique.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jeu()
    {
        return $this->belongsTo(Jeu::class);
    }

    /**
     * Relation avec l'utilisateur.
     * Chaque participation appartient à un utilisateur spécifique.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Méthode pour vérifier si la participation est gagnante.
     * Une participation est gagnante si l'attribut gagnant est true.
     *
     * @return bool
     */
    public function estGagnante()
    {
        return $this->gagnant;
    }

    /**
     * Méthode pour marquer la participation comme gagnante.
     * Met à jour l'attribut gagnant et le prix gagné.
     *
     * @param float $prix
     * @return void
     */
    public function marquerCommeGagnant($prix)
    {
        $this->update([
            'gagnant' => true,
            'prix_gagne' => $prix,
        ]);
    }
}
