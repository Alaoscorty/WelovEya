<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant un intervenant dans le système.
 * Un intervenant est une personne qui participe à des activités, comme un artiste, un animateur, etc.
 */
class Intervenant extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom', // Nom de l'intervenant
        'prenom', // Prénom de l'intervenant
        'email', // Adresse email de l'intervenant
        'telephone', // Numéro de téléphone de l'intervenant
        'specialite', // Spécialité ou domaine d'expertise de l'intervenant
        'biographie', // Biographie courte de l'intervenant
        'photo', // Chemin vers la photo de l'intervenant
        'statut', // Statut de l'intervenant (Actif, Inactif)
    ];

    /**
     * Relation avec les activités auxquelles l'intervenant participe.
     * Un intervenant peut participer à plusieurs activités.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activites()
    {
        return $this->belongsToMany(Activite::class);
    }

    /**
     * Méthode pour obtenir le nom complet de l'intervenant.
     * Concatène le prénom et le nom.
     *
     * @return string
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Méthode pour vérifier si l'intervenant est actif.
     * Un intervenant est considéré actif si son statut est 'actif'.
     *
     * @return bool
     */
    public function estActif()
    {
        return $this->statut === 'actif';
    }
}
