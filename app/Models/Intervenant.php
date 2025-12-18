<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'role', 'photo', 'statut'];

    // Relation avec les actions
    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    // Relation avec les votes
    public function votes()
{
    return $this->hasMany(Vote::class);
}

}
