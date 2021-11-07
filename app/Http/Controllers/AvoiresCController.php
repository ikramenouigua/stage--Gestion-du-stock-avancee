<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Avoire_C;
use App\Models\LigneAvoire_C;
use App\Models\BondeLivraison;
use App\Models\CommandeClient;
use App\Models\LigneBonndeLivraison;
use DB;
use PDF;


class AvoiresCController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:creer avoiresClient', ['only' => ['index','store']]);
         $this->middleware('permission:liste avoiresClient', ['only' => ['liste']]);
    }
   

   public function index(){
    $notifications = auth()->user()->unreadNotifications->count();
       $categories = Categorie::get();
       $clients    = Client::get();
       $commandes=  CommandeClient::get();
       $avoires=  Avoire_C::get();
       $ref='';
       $etat = 'validée';
       $cmds = DB::select('select * from commande_clients where etat_commande = ?',[$etat]);
       $cmd=''; $nom='';
       $lignes = [];
       foreach($cmds as $c){
           // $cmd =  $c->reference_commande;
           $lignes = DB::select('select * from lignecommandesclients , products where lignecommandesclients.id_produit = products.id and lignecommandesclients.id_commande_client = ?',[$cmd]);
       }
     
       return view('avoirsC.index')
       ->with('avoires',$avoires)
       ->with('clients',$clients)
       ->with('categories',$categories)
       ->with('lignes',$lignes)
       ->with('ref',$ref)
       ->with('nom',$nom)
       ->with('commandes',$commandes)
       ->with('notif',$notifications);
   }
   public function commande(Request $request){
    $etat = 'validée';
    $ref = $request->get('ref');
    $lignes = DB::table('lignecommandesclients')
    ->join('commande_clients', 'commande_clients.reference_commande', '=', 'lignecommandesclients.id_commande_client')
    ->join('products', 'products.id', '=', 'lignecommandesclients.id_produit')
    ->select('*')
    ->where('commande_clients.etat_commande',$etat)
    ->where('commande_clients.id',$ref)
    ->get();
    $commandes = DB::select('select * from commande_clients where etat_commande = ?',[$etat]);
    $categories = Categorie::get();
    $clients = Client::get();
    $notifications = auth()->user()->unreadNotifications->count();
    $client = DB::table('commande_clients')
    ->join('clients', 'clients.id', '=', 'commande_clients.id_client')
    ->select('clients.nom')
    ->where('commande_clients.id',$ref)
    ->get();
    $nom = '';
     foreach($client as $f){
       $nom = $f->nom;
     }
     return view('avoirsC.index')
    ->with('clients',$clients)
    ->with('categories',$categories)
    ->with('lignes',$lignes)
    ->with('ref',$ref)
    ->with('nom',$nom)
    ->with('commandes',$commandes)
    ->with('notif',$notifications);
   }

   public function show($num){
    
       
   }
    // Generate PDF
    public function avoirepdf($ref) {
        //la date
        $date = date('y-m-d');
        $avoires=Avoire_C::get();
        $avoire = DB::select('select * from  avoire__c_s where
        numero_commande = ?',[$ref]);
      // retreive all records from lignecommandesclients
      $commandes = DB::select('select * from  commande_clients where
      reference_commande = ?',[$ref]);
      // retreive all records from lignecommandesclients
      $lignes = DB::select('select * from lignecommandesclients where
      id_commande_client = ?',[$ref]);
      $entreprise = Entreprise::get();
      //des informations sur les clients
      $clients = DB::select('select * from commande_clients, clients where commande_clients.id_client = clients.id and commande_clients.reference_commande = ?',[$ref]);

      //des informations sur les produits
      $products = DB::select('select * from lignecommandesclients, products where lignecommandesclients.id_produit = products.id and lignecommandesclients.id_commande_client = ?',[$ref]);
      // share data to view
    
      view()->share('commandes',$commandes);
      view()->share('lignes',$lignes);
      view()->share('entreprise',$entreprise);
      view()->share('clients',$clients);
      view()->share('products',$products);
      view()->share('date',$date);
      view()->share('avoire',$avoire);
     
      $pdf = PDF::loadView('avoirPDF', $commandes);
        
      // download PDF file with download method+67
      return $pdf->download('avoire.pdf');
    }
   public function store(Request $request)
    {
     $request->validate([
        'nom_client',
        'numero_commande',
        'date_avoire',
        'ref_produit',
        'quantite',
        'id_avoire',
       
    ]);
   $product = $request->get('product');
    $ref = $request->get('ref');
    //dd($ref);
    $fourni = $request->get('id_client');
    $num = $request->get('ref_cmd');
    //extraire la référence du commande
    $references = DB::table('commande_clients')
    ->select('reference_commande')
    ->where('id',$num)
    ->get();
    $reference = '';
    foreach($references as $r){
        $reference = $r->reference_commande;
    }
    //etraire la date
    $cmd = DB::select('select * from commande_clients where reference_commande = ?',[$ref]);
    $date =  date('Y-m-d');
    foreach($cmd as $c){
        $date = $cmd->date_cmd_client;
    }
    
    //save the informations into avoires_f table
    $avoire = new Avoire_C();
    $avoire->nom_client = $fourni;
    $avoire->numero_commande = $num;
    $avoire->date_avoire = $date;
    $avoire->save();
    $ids = DB::select('select * from avoire__c_s where numero_commande = ?',[$num]);
    $id = 0;
    foreach($ids as $i){
        $id = $i->id;
    }
    foreach ($product as $pro => $valeur){
        $qte = $request->get('quantite_'.$valeur);
        //dd($qte);
        $ligne = new LigneAvoire_C();
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
        $new_q   = $qantite + $qte;
        //Modifier le total des produits
        $qantite = 0;
        $new_total = 0;
        $total = 0;
        $commande = DB::table('commande_clients')
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
       $cmds = DB::table('commande_clients')
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
        $newQuant = DB::table('commande_clients')
        ->where('id', $num)
        ->update(['total_produits' => $new_total, 'prix_total' => $prix_total]);
        //Modifier la table ligne_commandes
        $product = DB::table('lignecommandesclients')
        ->select('*')
        ->where('id_commande_client',$reference)
        ->where('id_produit',$valeur)
        ->delete();
        //Supprimer les commandes nulls
        $v = 0;
        $products = DB::table('commande_clients')
       ->select('*')
       ->where('total_produits',$v)
       ->delete();
     
   }
        return redirect()->back()->with('message', 'avoire stored successfully!' );
          }
   
          public function liste(){
            //$avoires =  Avoire_F::get();
            $avoires = DB::table('ligne_avoire__c_s')
            ->join('avoire__c_s', 'avoire__c_s.id', '=', 'ligne_avoire__c_s.id_avoire')
            ->join('products', 'products.id', '=', 'ligne_avoire__c_s.ref_produit')
            ->select('*')
            ->get();
            $identifiant ='';$date_avoire='';$nom_client='';$numero_commande='';
            $notifications = auth()->user()->unreadNotifications->count();
            return view('avoirsC.liste')
            ->with('avoires',$avoires)
            ->with('identifiant',$identifiant)
            ->with('date_avoire',$date_avoire)
            ->with('nom_client',$nom_client)
            ->with('numero_commande',$numero_commande)
            ->with('notif',$notifications);
       }
      
      public function search(Request $request){
          $id = $request->get('search');
           
          
          //$avoires =  Avoire_F::get();
          $avoires = DB::table('ligne_avoire__c_s')
          ->join('avoire__c_s', 'avoire__c_s.id', '=', 'ligne_avoire__c_s.id_avoire')
          ->join('products', 'products.id', '=', 'ligne_avoire__c_s.ref_produit')
          ->select('*')
          ->where('avoire__c_s.id',$id)
          ->get();
          $identifiant ='';$date_avoire='';$nom_client='';$numero_commande='';
          foreach($avoires as $a){
           $identifiant = $a->id_avoire;
           $date_avoire = $a->date_avoire;
           $nom_client = $a->nom_client;
           $ref = $a->numero_commande;
           $numero= DB::select('select reference_commande from commande_clients where id=?',[$ref]);
           foreach($numero as $n){
               $numero_commande = $n->reference_commande;
           }
  
          }
          $notifications = auth()->user()->unreadNotifications->count();
          return view('avoirsC.liste')
          ->with('avoires',$avoires)
          ->with('identifiant',$identifiant)
          ->with('date_avoire',$date_avoire)
          ->with('nom_client',$nom_client)
          ->with('numero_commande',$numero_commande)
          ->with('notif',$notifications);
           
      }
}
