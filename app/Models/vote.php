<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'intervenant_id',
        'type',
        'user_name'
    ];

    // Relation inverse vers Intervenant
    public function intervenant()
    {
        return $this->belongsTo(Intervenant::class);
    }
}
