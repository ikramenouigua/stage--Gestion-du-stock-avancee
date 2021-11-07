<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stocke;
use DB;

class StockeController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:liste stock', ['only' => ['index']]);
        
    }

    public function index(){
        $notifications = auth()->user()->unreadNotifications->count();
        $stockes = Stocke::get();
        $products = Product::get();
        //Extraire les entrées
         $e = 'validée';
         $commande_f = DB::select('select * from commande_fournisseurs, lignecommandes, products where commande_fournisseurs.reference_commande = lignecommandes.id_commande_fourni
          and lignecommandes.id_produit = products.id and commande_fournisseurs.etat_commande = ?',[$e]);
        
        //extraire les sortis
        $commande_c = DB::select('select * from commande_clients, lignecommandesclients, products where commande_clients.reference_commande = lignecommandesclients.id_commande_client
        and lignecommandesclients.id_produit = products.id and commande_clients.etat_commande = ?',[$e]);


        return view('stocke.index', compact('stockes'))
        ->with('products',$products)
        ->with('commande_f',$commande_f)
        ->with('commande_c',$commande_c)
        ->with('notif',$notifications);
    }
    

    public function rechercher(Request $request){
        // Get the search value from the request
        $notifications = auth()->user()->unreadNotifications->count();
           $search = $request->input('search');
           $e = 'validée';
        
           $commande_f = DB::table('commande_fournisseurs')
           ->join('lignecommandes', 'lignecommandes.id_commande_fourni', '=', 'commande_fournisseurs.reference_commande')
           ->join('products', 'products.id', '=', 'lignecommandes.id_produit')
           ->select('*')
           ->where('commande_fournisseurs.etat_commande',$e)
           ->where('lignecommandes.id_produit',$search)
           ->get();

           $commande_c = DB::table('commande_clients')
           ->join('lignecommandesclients', 'lignecommandesclients.id_commande_client', '=', 'commande_clients.reference_commande')
           ->join('products', 'products.id', '=', 'lignecommandesclients.id_produit')
           ->select('*')
           ->where('commande_clients.etat_commande',$e)
           ->where('lignecommandesclients.id_produit',$search)
           ->get();

        // Search in the title and body columns from the posts table
        $stockes = Stocke::query()
            ->where('Référence_produit', 'LIKE', "%{$search}%")
            ->get();
          
            $products = Product::get();
        // Return the search view with the resluts compacted
        return view('stocke.index', compact('stockes'))
        ->with('products',$products)
        ->with('commande_f',$commande_f)
        ->with('commande_c',$commande_c)
        ->with('notif',$notifications);
        
        
    }

      /* if($p!=null){
        //remplir la table stocke
        foreach ($p as $produit => $val){
        $reference = DB::select('select * from products where id =?',[$val]);
        $stocke_initiale = 0;
        $ref_product = '';
        foreach($reference as $re){
            $stocke_initiale = $re->stocke;
            $ref_product = $re->ref_produit;
           
        }
    }
    
        $stocke = new Stocke();
        $stocke->date_entree = $date;
        $stocke->ref_cmd = $ref;
        $stocke->Référence_produit = $val;
        $stocke->ref_produit = $ref_product;
        $stocke->stocke_initial = $stocke_initiale;
        $stocke->entree = $request->get('quantite_'.$val);;
        $stocke->save();
        
        }*/
                    /*
             //enregistrer les données dans la table stocke
             foreach ($p as $produit => $val){
               $date_sortie = $date;
               $sortie = $request->get('quantite_'.$val);
              
               //modifier la sortie de stocke
               $stocke = DB::table('stockes')
              ->where('Référence_produit', $val)
              ->where('date_entree', $d)
              ->update(['date_sortie' => $date_sortie , 'sortie' => $sortie]);  
             }
               //le noveau stocke 
               $infstock = DB::table('stockes')
               ->select('*')
               ->where('date_entree',$d)
               ->where('Référence_produit',$val)
               ->get();
               $entree_stocke = 0;
               $sortie_stocke = 0;
               $stocke_init = 0;
               foreach($infstock as $inf){
                   $entree_stocke = $inf->entree;
                   $sortie_stocke = $inf->sortie;
                   $stocke_init = $inf->stocke_initial;

               }
               $new_s =  ($entree_stocke + $stocke_init)  - $sortie_stocke;
                
                $newStocke = DB::table('stockes')
                ->where('Référence_produit', $val)
                ->where('date_sortie', $d)
                ->update(['new_stocke' => $new_s]);  */


}
