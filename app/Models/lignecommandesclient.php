<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lignecommandesclient extends Model
{
    use HasFactory;

     
    protected $fillable = [
        'id',
        'id_commande_client',
        'id_produit',
        'quantite_cmd',
        'total_tva',
        'total_ttc',
    ];
}
