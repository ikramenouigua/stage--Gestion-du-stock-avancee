<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Avoire_F;
use App\Models\LigneAvoire_F;
use App\Models\Fournisseur;
use App\Models\BondeLivraison;
use App\Models\CommandeClient;
use App\Models\LigneBonndeLivraison;
use DB;
use PDF;


class AvoiresFController extends Controller
{
    function __construct()
    {
        
    }

   public function index(){
    $notifications = auth()->user()->unreadNotifications->count();
       $categories = Categorie::get();
       $fournisseurs = Fournisseur::get();
       $avoires=  Avoire_F::get();
       $ref='';
       $etat = 'validée';
       $commandes = DB::select('select * from commande_fournisseurs where etat_commande = ?',[$etat]);
       $cmd='';
       $lignes = [];
       foreach($commandes as $c){
           // $cmd =  $c->reference_commande;
           $lignes = DB::select('select * from lignecommandes, products where lignecommandes.id_produit = products.id and lignecommandes.id_commande_fourni = ?',[$cmd]);
       }
        $nom ='';
       return view('avoirsF.index')
       ->with('fournisseurs',$fournisseurs)
       ->with('categories',$categories)
       ->with('lignes',$lignes)
       ->with('ref',$ref)
       ->with('avoires',$avoires)
       ->with('nom',$nom)
       ->with('commandes',$commandes)
       ->with('notif',$notifications);
   }
   public function commande(Request $request){
    $notifications = auth()->user()->unreadNotifications->count();
    $etat = 'validée';
    $ref = $request->get('ref');
    $lignes = DB::table('lignecommandes')
    ->join('commande_fournisseurs', 'commande_fournisseurs.reference_commande', '=', 'lignecommandes.id_commande_fourni')
    ->join('products', 'products.id', '=', 'lignecommandes.id_produit')
    ->select('*')
    ->where('commande_fournisseurs.etat_commande',$etat)
    ->where('commande_fournisseurs.id',$ref)
    ->get();
    //Get le fournisseur
     $fournisseur = DB::table('commande_fournisseurs')
    ->join('fournisseurs', 'fournisseurs.id', '=', 'commande_fournisseurs.id_fournisseur')
    ->select('fournisseurs.nom_fournisseur')
    ->where('commande_fournisseurs.id',$ref)
    ->get();
    $nom = '';
     foreach($fournisseur as $f){
       $nom = $f->nom_fournisseur;
     }
    $commandes = DB::select('select * from commande_fournisseurs where etat_commande = ?',[$etat]);
    $categories = Categorie::get();
    $fournisseurs = Fournisseur::get();
     return view('avoirsF.index')
    ->with('fournisseurs',$fournisseurs)
    ->with('categories',$categories)
    ->with('lignes',$lignes)
    ->with('ref',$ref)
    ->with('nom',$nom)
    ->with('commandes',$commandes)
    ->with('notif',$notifications);
   }

   public function show($num){
    
       
   }

   public function store(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications->count();
     $request->validate([
        'nom_fournisseur',
        'numero_commande',
        'date_avoire',
        'ref_produit',
        'quantite',
        'id_avoire',
       
    ]);
   $product = $request->get('product');
    $ref = $request->get('ref');
    //dd($ref);
    $fourni = $request->get('fourni');
    //dd($fourni);
    $num = $request->get('ref_cmd');
    //extraire la référence du commande
    $references = DB::table('commande_fournisseurs')
    ->select('reference_commande')
    ->where('id',$num)
    ->get();
    $reference = '';
    foreach($references as $r){
        $reference = $r->reference_commande;
    }
    //etraire la date
    $cmd = DB::select('select * from commande_fournisseurs where reference_commande = ?',[$ref]);
    $date =  date('Y-m-d');
    foreach($cmd as $c){
        $date = $cmd->date_cmd_fournisseur;
    }
    
    //save the informations into avoires_f table
    $avoire = new Avoire_F();
    $avoire->nom_fournisseur = $fourni;
    $avoire->numero_commande = $num;
    $avoire->date_avoire = $date;
    $avoire->save();
    $ids = DB::select('select * from avoire__f_s where numero_commande = ?',[$num]);
    $id =0;
    foreach($ids as $i){
        $id = $i->id;
    }
    foreach ($product as $pro => $valeur){
        $qte = $request->get('quantite_'.$valeur);
        //dd($qte);
        $ligne = new LigneAvoire_F();
        $ligne->ref_produit = $valeur;
        $ligne->quantite = $qte;
        $ligne->id_avoire = $id;
        $ligne->save();
        //Sélectionner des informations depuis la table produits
        $produit = DB::table('products')
        ->select('*')
        ->where('id',$valeur)
        ->get();
        $qantite = 0;
        foreach($produit as $p){
        $qantite = $p->quantite;
    }
        //Modifier la quantité du produit
        $new_q   = $qantite - $qte;
        //Modifier le total des produits
        $qantite = 0;
        $new_total = 0;
        $total = 0;
        $commande = DB::table('commande_fournisseurs')
        ->select('total_produits')
        ->where('id',$num)
        ->get();
        foreach($commande as $c){
             $total = $c->total_produits;
        }
        $new_total = $total - $qte;
        //Modifier la table produit
        $newStocke = DB::table('products')
        ->where('products.id', $valeur)
        ->update(['products.quantite' => $new_q]);
        //modifier la commande fournisseur
         //Relcalculer le prix total
       $cmds = DB::table('commande_fournisseurs')
       ->select('*')
       ->where('id',$num)
       ->get();
       $t = 0;
       $prix = 0.0;
       $prix_total = 0.0;
       foreach($cmds as $cmd){
       $t = $cmd->total_produits;
       }
       //Sélectionner le prix de vente
       $products = DB::table('products')
       ->select('*')
       ->where('id',$valeur)
       ->get();
       foreach($products as $p){
          $prix = $p->prix_vente;
       }
       $prix_total = $t * $prix;
        $newQuant = DB::table('commande_fournisseurs')
        ->where('id', $num)
        ->update(['total_produits' => $new_total, 'prix_total' => $prix_total]);
        //Modifier la table ligne_commandes
        $product = DB::table('lignecommandes')
        ->select('*')
        ->where('id_commande_fourni',$reference)
        ->where('id_produit',$valeur)
        ->delete();
        //Supprimer les commandes nulls
        $v = 0;
        $products = DB::table('commande_fournisseurs')
       ->select('*')
       ->where('total_produits',$v)
       ->delete();
     
   }
        return redirect()->back()
        ->with('message', 'avoire stored successfully!' );
          }
   
     public function liste(){
        $notifications = auth()->user()->unreadNotifications->count();
          //$avoires =  Avoire_F::get();
          $avoires = DB::table('ligne_avoire__f_s')
          ->join('avoire__f_s', 'avoire__f_s.id', '=', 'ligne_avoire__f_s.id_avoire')
          ->join('products', 'products.id', '=', 'ligne_avoire__f_s.ref_produit')
          ->select('*')
          ->get();
          $identifiant ='';$date_avoire='';$nom_fournisseur='';$numero_commande='';
          return view('avoirsF.liste')
          ->with('avoires',$avoires)
          ->with('identifiant',$identifiant)
          ->with('date_avoire',$date_avoire)
          ->with('nom_fournisseur',$nom_fournisseur)
          ->with('numero_commande',$numero_commande)
          ->with('notif',$notifications);
     }
    
    public function search(Request $request){
        $id = $request->get('search');
         
        
        //$avoires =  Avoire_F::get();
        $avoires = DB::table('ligne_avoire__f_s')
        ->join('avoire__f_s', 'avoire__f_s.id', '=', 'ligne_avoire__f_s.id_avoire')
        ->join('products', 'products.id', '=', 'ligne_avoire__f_s.ref_produit')
        ->select('*')
        ->where('avoire__f_s.id',$id)
        ->get();
        $identifiant ='';$date_avoire='';$nom_fournisseur='';$numero_commande='';
        foreach($avoires as $a){
         $identifiant = $a->id_avoire;
         $date_avoire = $a->date_avoire;
         $nom_fournisseur = $a->nom_fournisseur;
         $ref = $a->numero_commande;
         $numero= DB::select('select reference_commande from commande_fournisseurs where id=?',[$ref]);
         foreach($numero as $n){
             $numero_commande = $n->reference_commande;
         }

        }
        return view('avoirsF.liste')
        ->with('avoires',$avoires)
        ->with('identifiant',$identifiant)
        ->with('date_avoire',$date_avoire)
        ->with('nom_fournisseur',$nom_fournisseur)
        ->with('numero_commande',$numero_commande)
        ->with('notif',$notifications);
         
    }
    public function avoirepdf_F($ref) {
        //la date
        $date = date('y-m-d');
        $avoires=Avoire_F::get();
        $avoire = DB::select('select * from  avoire__f_s where
        numero_commande = ?',[$ref]);
      // retreive all records from lignecommandesclients
      $commandes = DB::select('select * from  commande_fournisseurs where
      reference_commande = ?',[$ref]);
      // retreive all records from lignecommandesclients
      $lignes = DB::select('select * from lignecommandes where
      id_commande_fourni = ?',[$ref]);
      $entreprise = Entreprise::get();
      //des informations sur les clients
      $fournisseurs = DB::select('select * from commande_fournisseurs, fournisseurs where commande_fournisseurs.id_fournisseur = fournisseurs.id and commande_fournisseurs.reference_commande = ?',[$ref]);

      //des informations sur les produits
      $products = DB::select('select * from lignecommandes, products where lignecommandes.id_produit = products.id and lignecommandes.id_commande_fourni = ?',[$ref]);
      // share data to view
    
      view()->share('commandes',$commandes);
      view()->share('lignes',$lignes);
      view()->share('entreprise',$entreprise);
      view()->share('fournisseurs',$fournisseurs);
      view()->share('products',$products);
      view()->share('date',$date);
      view()->share('avoire',$avoire);
     
      $pdf = PDF::loadView('avoirPDF_F', $commandes);
        
      // download PDF file with download method+67
      return $pdf->download('avoire.pdf');
    }
}
