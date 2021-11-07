<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_devis',
        'numero_commande',
    ];
}
