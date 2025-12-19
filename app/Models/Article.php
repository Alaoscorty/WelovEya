<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id', 'nom_article', 'type_article', 'prix', 'quantite'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
