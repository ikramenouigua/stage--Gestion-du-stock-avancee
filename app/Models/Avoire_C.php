<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avoire_C extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom_client',
        'numero_commande',
        'date_avoire',
    ];
}
