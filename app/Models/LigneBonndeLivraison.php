<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneBonndeLivraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_produit',
        'prix_total',
        'total_ttc',
        'total_tva',
        'numero_livraison',
    ];
}
