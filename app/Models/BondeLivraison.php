<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BondeLivraison extends Model
{
    use HasFactory;


    protected $fillable = [
        'date_bl',
        'etat_facture',
        'conditionnement',
        'prix_total',
        'total_ttc',
        'total_tva',
        'id_client',
        'numero_commande',
        'qte_commandee',
        'qte_livree',
        'mode_payement',
    ];
       
}
