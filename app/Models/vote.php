<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['intervenant_id', 'type'];

    public function intervenant()
    {
        return $this->belongsTo(Intervenant::class);
    }
}
