<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avoire_F extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom_fournisseur',
        'numero_commande',
        'date_avoire',
    ];
}
