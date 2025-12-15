<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_du_jeu', 'description', 'partenaire', 'type_du_jeu',
        'reseau_social', 'lien_du_jeu', 'date_debut', 'date_fin',
        'recompense', 'nombre_gagnants'
    ];
    protected $table = 'jeux';
    protected $dates = ['date_debut', 'date_fin'];

}
