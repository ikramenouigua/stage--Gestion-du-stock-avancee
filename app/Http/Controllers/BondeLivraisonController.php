<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\BondeLivraison;
use App\Models\CommandeClient;
use App\Models\LigneBonndeLivraison;
use DB;
use PDF;


class BondeLivraisonController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:creer bondeLivraison|afficher bondeLivraison|bondeLivraison-listeBL|bondeLivraison-bondepdf', ['only' => ['listeBL']]);
        $this->middleware('permission:afficher bondeLivraison', ['only' => ['show']]);
         $this->middleware('permission:creer bondeLivraison', ['only' => ['index','store']]);
         $this->middleware('permission:avoiresClient-listeBL', ['only' => ['listeBL']]); 
         $this->middleware('permission:avoiresClient-bondepdf', ['only' => ['bondepdf']]);
    }

   public function index(){
    $notifications = auth()->user()->unreadNotifications->count();    
       $products = Product::get();
       $clients = Client::get();
       $categories = Categorie::get();
       $etat = 'validée';
       $commandes = DB::select('select * from commande_clients where etat_commande = ?',[$etat]);
       return view('bondelivraison.create')
       ->with('products',$products)
       ->with('clients',$clients)
       ->with('categories',$categories)
       ->with('commandes',$commandes)
       ->with('notif',$notifications);
   }

   public function show($num){
    $notifications = auth()->user()->unreadNotifications->count();    
       $infos = DB::select('select * from ligne_bonnde_livraisons , products where ligne_bonnde_livraisons.id_produit =
        products.id and ligne_bonnde_livraisons.numero_livraison = ?',[$num]);

       
       return view('bondelivraison.show',['infos'=>$infos])
       ->with('notif',$notifications);
       
   }

   public function store(Request $request)
    {
     $request->validate([
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
                       
        'id_produit',
        'prix_total',
        'total_ttc',
        'total_tva',
        'numero_livraison',
    ]);
    //get the attributes
    $product = $request->get('product');
    $date = $request->get('date_bl');
    $etat_facture = $request->get('etat_facture');
    $mode_payement = $request->get('mode_payement');
    $conditionnement = $request->get('conditionnement');
    $numero_commande = $request->get('numero_commande');
    $id_client = $request->get('id_client');
    //sélectionner la référence du commande
    $reference = DB::select('select commande_clients.reference_commande from commande_clients where id = ?',[$numero_commande]);
    //$reference = CommandeClient::whereIn('id', $noAdminUsersId);
    $ref = '';
    foreach($reference as $val){
       $ref = $val;
    }
   //extraire la date depuis la table commandefournisseur
   $cmd_f = DB::select('select * from commande_clients where reference_commande = ?',[$numero_commande]);
   $d = $date;
   foreach($cmd_f as $f){
       $d = $f->date_cmd_client;
         }
    //la quantité livree
    $count =0;
    foreach ($product as $pro => $valeur){
     $count += $request->get('quantite_'.$valeur);
       }
        $total = $count;
    //la quantite commandee
    $qte_commandee = DB::select('select * from commande_clients where id = ?',[$numero_commande]);
    $qte_c = 0;

    foreach($qte_commandee as $q){
        $qte_c = $q->quantite_cmd;
    }

    //enregistrer les données dans la base de données
    $b = new BondeLivraison();
    $b->date_bl = $date;
    $b->etat_facture = $etat_facture;
    $b->mode_payement = $mode_payement;
    $b->conditionnement = $conditionnement;
    $b->numero_commande = $numero_commande;
    $b->id_client = $id_client;
    $b->qte_livree = $total;
    $b->qte_commandee = $qte_c;

    $b->save();
     //get le numéro de livraison
     $num = DB::select('select * from bonde_livraisons where numero_commande = ?',[$numero_commande]);
     $numero_livraison = 0;
     foreach($num as $n){
     $numero_livraison = $n->id;
     }
    //enregistrer les informations dans la table ligne bonde de livraison
    $tva = 0; $ttc=0;

   foreach ($product as $prod => $val){
        $ligne = new LigneBonndeLivraison(); 
        $quantite = $request->get('quantite_'.$val);
        $ligne->id_produit = $val;
        $ligne->numero_livraison = $numero_livraison;
        $ligne->qte = $quantite;
        $prix_vente = DB::select('select * from products where products.id = ?',[$val]);
        $prix = 0.0;
        foreach($prix_vente as $price){
            $prix = $price->prix_vente;
        }
    
        $ligne->prix_total = $prix * $quantite;
        $tva = round( 100 * $prix * (1 + 20 / 100) ) / 100;
        $ttc = $prix + $tva;
        $ligne->total_tva = $tva;
        $ligne->total_ttc = $ttc;
        $ligne->save();
    }

    //modifier les prix
    $lignesliv = DB::select('select * from ligne_bonnde_livraisons , products
    where ligne_bonnde_livraisons.id_produit = products.id
    AND  ligne_bonnde_livraisons.numero_livraison = ?',[$numero_livraison]);
     //calculer le prix total de la commande
     $total = 0;  
    foreach($lignesliv as $lignel){
        $price = $lignel->prix_vente;
        $quant = $lignel->qte;
        $prixliv = $price * $quant;
        $total += $prixliv;
       
    }   
    //Enregistrer le total ttc tva dans la table bonde de livraison
  $liv_client = DB::select('select * from ligne_bonnde_livraisons where numero_livraison = ?',[$numero_livraison]);
  $ttc = 0.0;
  $tva = 0.0;
  foreach($liv_client as $liv){
   $t_ttc = $liv->total_ttc;
   $ttc += $t_ttc;

   $t_tva = $liv->total_tva;
   $tva += $t_tva;
  }
     $totalprice = $total;
     $update = DB::table('bonde_livraisons')
     ->where('id', $numero_livraison)
     ->update(['prix_total' => $totalprice , 'total_ttc' => $ttc , 'total_tva' =>$tva]); 

     //modifier le stocke
    $lignes = DB::select('select * from ligne_bonnde_livraisons where numero_livraison = ?',[$numero_livraison]);

    foreach($lignes as $l){
        $qa = $l->qte;
        $id = $l->id_produit;
    $product = DB::select('select * from products where id = ?',[$id]);
    foreach($product as $produit){
        $qan = $produit->quantite;
        $new_quant = $qan - $qa;
        //modifier la quantité de ce produit dans le stocke
        $update = DB::table('products')
        ->where('id', $id)
        ->update(['quantite' => $new_quant]); 
    }
    }
     
     

    return redirect()->back()->with('message', 'bonde livraison created successfully!' );
   
     
 }
 public function listeBL(){
      
    $bls = BondeLivraison::get();
    $commandes = CommandeClient::get();
    $notifications = auth()->user()->unreadNotifications->count();    
    return view('bondelivraison.listebl',compact('bls'))
        ->with('commandes',$commandes)
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('notif',$notifications);
 }

//imprimer bonde de livraison
// Generate PDF
public function bondepdf($num) {
    //date
    $date = date('y-m-d');
    // retreive all records from lignecommandesclients
    $commandes = DB::select('select * from  bonde_livraisons where id = ?',[$num]);
    $ref="";
    foreach($commandes as $c){
        $id = $c->numero_commande;
    $reference = DB::select('select reference_commande from commande_clients where id = ?',[$id]);
    foreach($reference as $r){
        $ref = $r->reference_commande;
    }
    }
    // retreive all records from lignecommandesclients
    $lignes = DB::select('select * from ligne_bonnde_livraisons where
    numero_livraison = ?',[$num]);
    $entreprise = Entreprise::get();
    //des informations sur les clients
    $clients = DB::select('select * from bonde_livraisons, clients where bonde_livraisons.id_client = clients.id and bonde_livraisons.id = ?',[$num]);

    //des informations sur les produits
    $products = DB::select('select * from ligne_bonnde_livraisons, products where ligne_bonnde_livraisons.id_produit = products.id and ligne_bonnde_livraisons.numero_livraison = ?',[$num]);
    // share data to view
    view()->share('commandes',$commandes);
    view()->share('lignes',$lignes);
    view()->share('entreprise',$entreprise);
    view()->share('clients',$clients);
    view()->share('products',$products);
    view()->share('ref',$ref);
    view()->share('date',$date);
    $pdf = PDF::loadView('pdf_livraison', $commandes);
      
    // download PDF file with download method+67
    return $pdf->download('bonde_livraison.pdf');
  }
    
  public function categorybl(Request $request)
  {
      
      $commandes = CommandeClient::latest()->paginate(5);
      $categories = Categorie::get();
      $clients = Client::get();
      $cat = $request->get('nom_cat');
     // dd($cat);
      $products = DB::select('select * from products where products.id_category =?',[$cat]);
      //$products = Product::get();
       // dd($request);
       $notifications = auth()->user()->unreadNotifications->count();    
      return view('bondelivraison.create',compact('commandes'))
          ->with('i', (request()->input('page', 1) - 1) * 5)
          ->with('categories',$categories)
          ->with('clients',$clients)
          ->with('products',$products)
          ->with('notif',$notifications);
  }
}
