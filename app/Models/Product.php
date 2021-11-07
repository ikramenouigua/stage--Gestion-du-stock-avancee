<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    // protected $guarded = [];
    protected $fillable = [
        'id',
        'ref_produit',
        'libelle_produit',
        'unite_produit',
        'quantite',
        'stocke_min',
        'prix_achat',
        'prix_vente',
        'id_category',
        'image_produit',
        'description',
    ];

    public function lignecommandeF(){
         return $this->belongsTo(lignecommande::class);
    }
}

?>