<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lignecommande extends Model
{
    
    protected $fillable = [
        'id',
        'id_commande_fourni',
        'id_produit',
        'quantite_cmd',
    ];

    public function commandes(){
        return $this->belongsTo(commande_fournisseur::class);
   }
   
  

}
