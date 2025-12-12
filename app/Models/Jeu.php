<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant un jeu dans le système.
 * Un jeu peut être un jeu concours, un jeu de hasard, etc., organisé dans le cadre de l'événement.
 */
class Jeu extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom', // Nom du jeu
        'description', // Description détaillée du jeu
        'type', // Type de jeu (Concours, Hasard, etc.)
        'date_debut', // Date et heure de début du jeu
        'date_fin', // Date et heure de fin du jeu
        'prix_participation', // Prix pour participer au jeu
        'prix_gain', // Prix du gain pour le gagnant
        'statut', // Statut du jeu (Actif, Inactif, Terminé)
        'regles', // Règles du jeu
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, les dates sont castées en datetime et les prix en décimal.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'prix_participation' => 'decimal:2',
        'prix_gain' => 'decimal:2',
    ];

    /**
     * Relation avec les participations au jeu.
     * Un jeu peut avoir plusieurs participations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participations()
    {
        return $this->hasMany(ParticipationJeu::class);
    }

    /**
     * Méthode pour vérifier si le jeu est actif.
     * Un jeu est considéré actif si son statut est 'actif' et que la date actuelle est entre la date de début et de fin.
     *
     * @return bool
     */
    public function estActif()
    {
        return $this->statut === 'actif' &&
               now()->between($this->date_debut, $this->date_fin);
    }

    /**
     * Méthode pour obtenir le nombre de participants.
     * Compte le nombre de participations au jeu.
     *
     * @return int
     */
    public function nombreParticipants()
    {
        return $this->participations()->count();
    }

    /**
     * Méthode pour obtenir le statut formaté.
     * Retourne une chaîne de caractères représentant le statut du jeu.
     *
     * @return string
     */
    public function getStatutFormateAttribute()
    {
        switch ($this->statut) {
            case 'actif':
                return 'Actif';
            case 'inactif':
                return 'Inactif';
            case 'termine':
                return 'Terminé';
            default:
                return 'Inconnu';
        }
    }
}
