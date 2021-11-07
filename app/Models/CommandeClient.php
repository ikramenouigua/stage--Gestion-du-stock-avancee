<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeClient extends Model
{
    protected $fillable = [
        'id',
        'reference_commande',
        'date_cmd_client',
        'prix_total',
        'total_produits',
        'id_client',
        'etat_commande',
        
    ];
}
