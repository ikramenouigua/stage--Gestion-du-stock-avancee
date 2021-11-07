<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commande_fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'reference_commande',
        'date_cmd_fournisseur',
        'prix_total',
        'total_produits',
        'id_fournisseur',
        'etat_commande',
    ];

    public function lignes(){
        return $this->hasMany(Lignecommande::class,'id_commande_fourni');
    }

}
