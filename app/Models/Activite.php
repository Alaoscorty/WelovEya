<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une activité dans le système.
 * Une activité peut être un concert, un atelier, une animation, etc., dans le cadre de l'événement.
 */
class Activite extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titre', // Titre de l'activité
        'description', // Description détaillée de l'activité
        'date_debut', // Date et heure de début de l'activité
        'date_fin', // Date et heure de fin de l'activité
        'lieu', // Lieu où se déroule l'activité
        'capacite_max', // Capacité maximale de participants
        'prix', // Prix de participation à l'activité
        'statut', // Statut de l'activité (Planifiée, En cours, Terminée, Annulée)
        'type', // Type d'activité (Concert, Atelier, Animation, etc.)
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, les dates sont castées en datetime et la capacité et le prix en entier et décimal.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'capacite_max' => 'integer',
        'prix' => 'decimal:2',
    ];

    /**
     * Relation avec les intervenants participant à l'activité.
     * Une activité peut avoir plusieurs intervenants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function intervenants()
    {
        return $this->belongsToMany(Intervenant::class);
    }

    /**
     * Relation avec les inscriptions à l'activité.
     * Une activité peut avoir plusieurs inscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscriptions()
    {
        return $this->hasMany(InscriptionActivite::class);
    }

    /**
     * Méthode pour vérifier si l'activité est complète.
     * Une activité est complète si le nombre d'inscriptions atteint la capacité maximale.
     *
     * @return bool
     */
    public function estComplete()
    {
        return $this->inscriptions()->count() >= $this->capacite_max;
    }

    /**
     * Méthode pour obtenir le nombre de places disponibles.
     * Calcule les places restantes en soustrayant les inscriptions de la capacité maximale.
     *
     * @return int
     */
    public function placesDisponibles()
    {
        return max(0, $this->capacite_max - $this->inscriptions()->count());
    }

    /**
     * Méthode pour obtenir le statut formaté.
     * Retourne une chaîne de caractères représentant le statut de l'activité.
     *
     * @return string
     */
    public function getStatutFormateAttribute()
    {
        switch ($this->statut) {
            case 'planifiee':
                return 'Planifiée';
            case 'en_cours':
                return 'En cours';
            case 'terminee':
                return 'Terminée';
            case 'annulee':
                return 'Annulée';
            default:
                return 'Inconnu';
        }
    }
}
