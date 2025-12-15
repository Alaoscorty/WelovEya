<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'date_time',
        'duration',
        'slots',
        'registered',
        'reward',
        'status'
    ];
    protected $casts = [
    'date_time' => 'datetime',
    ];
    
     // Statut automatique
    public function getStatusAttribute()
    {
        if ($this->date_time < now()) {
            return 'termine';
        } elseif ($this->registered >= $this->slots) {
            return 'complet';
        } else {
            return 'ouvert';
        }
    }

    // Couleur du badge
    public function getStatusClassAttribute()
    {
        return match($this->status) {
            'ouvert' => 'status-ouvert',
            'complet' => 'status-complet',
            'termine' => 'status-termine',
        };
    }
}
