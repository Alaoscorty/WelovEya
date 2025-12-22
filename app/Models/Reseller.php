<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory;

    protected $fillable = [
    'nom_complet',
    'email',
    'telephone',
    'date_adhesion',
    'statut',
    'commission_standard',
    'commission_premium',
    'commission_vip',
    'commission_elite',
    'stock_standard',
    'stock_premium',
    'stock_vip',
    'stock_elite',
];
}
