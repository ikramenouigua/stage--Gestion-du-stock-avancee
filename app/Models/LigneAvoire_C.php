<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneAvoire_C extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ref_produit',
        'quantite',
        'id_avoire',
    ];
}
