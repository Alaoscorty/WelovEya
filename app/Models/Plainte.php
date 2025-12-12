<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une plainte dans le système.
 * Une plainte peut être déposée par un utilisateur concernant un problème avec un ticket, une commande, etc.
 */
class Plainte extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Cela permet de créer ou mettre à jour plusieurs champs en une seule opération.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // ID de l'utilisateur qui dépose la plainte
        'objet', // Objet de la plainte (ex: Problème avec un ticket)
        'description', // Description détaillée de la plainte
        'statut', // Statut de la plainte (Ouverte, En cours, Résolue, Fermée)
        'date_depot', // Date de dépôt de la plainte
        'date_resolution', // Date de résolution de la plainte (optionnel)
        'reponse_admin', // Réponse de l'administrateur (optionnel)
    ];

    /**
     * Les attributs qui doivent être castés à des types spécifiques.
     * Ici, les dates sont castées en datetime.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_depot' => 'datetime',
        'date_resolution' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur.
     * Chaque plainte appartient à un utilisateur spécifique.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Méthode pour vérifier si la plainte est résolue.
     * Une plainte est considérée résolue si son statut est 'resolue' ou 'fermee'.
     *
     * @return bool
     */
    public function estResolue()
    {
        return in_array($this->statut, ['resolue', 'fermee']);
    }

    /**
     * Méthode pour marquer la plainte comme résolue.
     * Met à jour le statut et la date de résolution.
     *
     * @param string $reponse
     * @return void
     */
    public function marquerCommeResolue($reponse = null)
    {
        $this->update([
            'statut' => 'resolue',
            'date_resolution' => now(),
            'reponse_admin' => $reponse,
        ]);
    }

    /**
     * Méthode pour obtenir le statut formaté.
     * Retourne une chaîne de caractères représentant le statut de la plainte.
     *
     * @return string
     */
    public function getStatutFormateAttribute()
    {
        switch ($this->statut) {
            case 'ouverte':
                return 'Ouverte';
            case 'en_cours':
                return 'En cours';
            case 'resolue':
                return 'Résolue';
            case 'fermee':
                return 'Fermée';
            default:
                return 'Inconnu';
        }
    }
}
