<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use App\Models\CommandeClient;
use App\Models\Categorie;
use App\Models\lignecommandesclient;
use App\Models\Setting;
use App\Models\Devi;
use App\Models\Entreprise;
use App\Models\facture_client;
use App\Models\Avoire_C;
use App\Models\groupClient;
use App\Notifications\StockNotification;
use Illuminate\Http\Request;
use DB;
use PDF;

class CommandeClientController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:listeBC commandeC|creer commandeC|modifier commandeC|supprimer commandeC|creerPDF commandeC|facturePDF commandeC|devisPDF commandeC', ['only' => ['index','listBC']]);
         $this->middleware('permission:creer commandeC', ['only' => ['create','store']]);
         $this->middleware('permission:modifier commandeC', ['only' => ['edit','update']]);
         $this->middleware('permission:supprimer commandeC', ['only' => ['destroy']]);
         $this->middleware('permission:creerPDF commandeC', ['only' => ['createPDF']]);
         $this->middleware('permission:facturePDF commandeC', ['only' => ['facturepdf']]);
         $this->middleware('permission:devisPDF commandeC', ['only' => ['devipdf']]);
         $this->middleware('permission:listeBC commandeC', ['only' => ['listBC']]);
    }
   
        public function index()
        {
            
        $commandes = CommandeClient::latest()->paginate(5);
        $categories = Categorie::get();
        $client = Client::get();
        
        $products = Product::get();
        $notifications = auth()->user()->unreadNotifications->count();
        return view('commandesC.index',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories',$categories)
            ->with('client',$client)
            ->with('products',$products)
            ->with('notif',$notifications);
        }
        
        public function create()
        {
           
         
        }
        
       
        public function store(Request $request)
        {
            $request->validate([
                'date_cmd_client',
                'quantite_cmd',
                'reference_commande',
                'id_client',
                'total_ht',
                'total_tva',
                'total_ttc',

                'id_commande_client',
                'id_produit',
                'quantite_cmd',
                'prix_total',
                'etat_commande',
            
                'date_devis',
                'numero_commande',
                'id_client',
               
            ]);
           // dd($request);
            $qte = $request->get('quantite');
            $count = 0;
            $date = date('Y-m-d');
            $cat = $request->get('nom_cat');
            $client = $request->get('client');
            //dd($client);
        
            //find prifix commande
            $settings = DB::select('select * from settings');
            $prefix=0;
            $order = 0; 
            $cmd = 0;
            foreach($settings as $s){
                $prefix = $s->prefix;
                $order = $s->order;
            }
            $ref = $prefix . $order;
            $p = $request->get('product');
    
           // dd($count);
           $test=1;
            foreach ($p as $pro => $valeur){
                $prod=Product::find($valeur);
                $qte=$request->get('quantite_'.$valeur);
                if((($prod->quantite)- $qte) <($prod->stocke_min)){
                    $test=0;
                break;}
            $count += $request->get('quantite_'.$valeur);
            $prix_total=$request->get('quantite_'.$valeur)*$request->get('prix_'.$valeur);
            }
            $total = $count;
            
            //enregistrer les données dans la table commande Client
            $clientt=Client::find($client);
            $group=groupClient::find($clientt->id_group_client);
            if($test==1){
            $c = new CommandeClient();
            $c->reference_commande =$ref;
            $c->date_cmd_client = $date;
            $c->total_produits= $total;
            $c->id_client = $client;
            $c->etat_commande = 'en cours';
            $remise=$group->remise;
            $c->remise=$remise;
            $c->prix_total=$prix_total-$remise;
            $c->save();
           
           
            //enregistrer les données dans la table ligne de commande
            // dd($request);
            // dd($request->get('quantite_2'));
            $tva = 0; $ttc=0;
        
           
           foreach ($p as $prod => $val){
               $qte=$request->get('quantite_'.$val);
                DB::update('update products set quantite=quantite-? where id=?',[$qte,$val]);
              
                $pr = new lignecommandesclient(); 
                $pr->id_produit = $val;
                $pr->id_commande_client = $ref;
                $pr->quantite_cmd = $request->get('quantite_'.$val);
               
                $prix_vente = DB::select('select * from products where products.id = ?',[$val]);
                $prix = 0.0;
                foreach($prix_vente as $price){
                    $prix = $price->prix_vente;
                }
               
               
                $quanti = $request->get('quantite_'.$val);
                $pr->prix_total = $prix * $quanti;
                $tva = round( 100 * $prix * (1 + 20 / 100) ) / 100;
                $ttc = $prix + $tva;
                $pr->total_tva = $tva;
                $pr->total_ttc = $ttc;
                $pr->save();
           
            }
           
        
            DB::table('settings')->increment('order');
          
           
             $lignescmd = DB::select('select * from lignecommandesclients , products
             where lignecommandesclients.id_produit = products.id
             AND  id_commande_client = ?',[$ref]);
              //calculer le prix total de la commande
              $total = 0;  
             foreach($lignescmd as $lignec){
                 $price = $lignec->prix_vente;
                 $quant = $lignec->quantite_cmd;
                 $prixcmd = $price * $quant;
                 $total += $prixcmd;
                
             }   
             //Enregistrer le total ttc tva dans la table commande client
           $cmd_client = DB::select('select * from lignecommandesclients where id_commande_client = ?',[$ref]);
           $ttc = 0.0;
           $tva = 0.0;
           foreach($cmd_client as $cmd){
            $t_ttc = $cmd->total_ttc;
            $ttc += $t_ttc;

            $t_tva = $cmd->total_tva;
            $tva += $t_tva;
           }

              $totalprice = $total;
              $update = DB::table('commande_clients')
              ->where('reference_commande', $ref)
              ->update(['prix_total' => $totalprice ]); 
        
             
        
              //extraire la date depuis la table commandefournisseur
              $cmd_f = DB::select('select * from commande_clients where reference_commande = ?',[$ref]);
              $d = $date;
              foreach($cmd_f as $f){
                  $d = $f->date_cmd_client;
              }
              //Enregistrer le devis
            
              $devi = new Devi();
              $devi->date_devis = $date;
              $devi->numero_commande = $ref;
              $devi->id_client = $client;
              $devi->save();

              $avoir = new Avoire_C();
              $avoir->date_avoire = $date;
              $avoir->numero_commande = $ref;
              $avoir->nom_client = Client::find($client)->nom ;
              $avoir->save();
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
               
          //  return redirect()->back()->with('message', 'Commande created successfully!' );
            }else{
                User::find(1)->notify(new StockNotification($prod));
            }
          $commandes = CommandeClient::get();
          $categories = Categorie::get();
          $client = Client::get();
          
          $products = Product::get();
          $notifications = auth()->user()->unreadNotifications->count();
          return view('commandesC.index',compact('commandes'))
              ->with('i', (request()->input('page', 1) - 1) * 5)
              ->with('categories',$categories)
              ->with('client',$client)
              ->with('products',$products)
              ->with('notif',$notifications);
                
        }
         
        public function show($ligne)
        { 
            //$cmd = commande_fournisseur::find($ligne);
           // dd($cmd->lignes);
         //sélectionner les détails de la commande
          $lignes = DB::select('select * from lignecommandesclients , products
          where lignecommandesclients.id_produit = products.id
           AND  id_commande_client = ?',[$ligne]);
         /*  $lignes = commande_fournisseur::find($ligne)
                                        ->join('lignecommandes', 'lignecommandes.id_commande_fourni', 'commande_fournisseurs.reference_commande')
                                        ->join("products",'products.id','lignecommandes.id_produit')
                                        ->where('id_produit',$ligne)
                                        ->get();*/
                                        //dd($lignes);
            /*$lignes = commande_fournisseur::find($ligne)
            ->join('lignecommandes', 'lignecommandes.id_commande_fourni', 'commande_fournisseurs.reference_commande')
            ->where('lignecommandes.id_commande_fourni',$ligne)
            ->get();*/
           //calculer le prix total des articles commandés
           $total = 0;  
           $cmd = 0; $quantite =0;
           foreach($lignes as $l){
               $price = $l->prix_vente;
               $quantite = $l->quantite_cmd;
               $prix = $price * $quantite;
               $total += $prix;
           }   
           $totalprice = $total;
           //Extraire le nom de fournisseur
          $nom = DB::select('select * from clients, commande_clients where clients.id = commande_clients.id_client AND commande_clients.reference_commande=?',[$ligne]);
          $name="";
          foreach($nom as $n){
           $name = $n->nom;
          }
          $notifications = auth()->user()->unreadNotifications;
          //Envoyer les données à la vue
          return view('commandesC.show',['lignes'=>$lignes, 'totalprice' =>$totalprice, 'name'=>$name])
          ->with('notif',$notifications);
        }
         
        /**
         * Show the form for editing the specified resource.
         *0
         * @param  \App\Lignecommandesclient  $product
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
    {
        $commandes = $id;
        $product = Product::get();
        $commandes_C = Client::get();
        $categories = Categorie::get();
        $lignes = DB::select('select * from lignecommandesclients,products where lignecommandesclients.id_produit = products.id and lignecommandesclients.id_commande_client=?',[$id]);
        //dd($lignes);
        $notifications = auth()->user()->unreadNotifications->count();
        return view('commandesC.edite',compact('commandes','product','lignes','commandes_C','categories'));
  
    }
    
    public function update(Request $request,$id)
    {
        $request->validate([
            'date_cmd_client',
            'total_produits',
            'reference_commande',
            'id_client',
            'total_ht',
            'total_tva',
            'total_ttc',

            'id_commande_client',
            'id_produit',
            'quantite_cmd',
            'prix_total',
            'etat_commande',
        ]);
        $ids = DB::select('select * from commande_clients where reference_commande =?',[$id]);
        $id_client = 0;
        $ref='';
        $dat='';
        foreach($ids as $i){
            $id_client = $i->id_client;
            $ref = $i->reference_commande;
            $dat = $i->date_cmd_client;
        }
      
       

        $p = $request->get('product');
        $date = date('Y-m-d');

        /*$c = DB::table('clients')
        ->select('*')
        ->where('id',$id_client)
        ->delete();*/
        $cmd = DB::table('commande_clients')
        ->select('*')
        ->where('reference_commande',$id)
        ->delete();   
         $l = DB::table('lignecommandesclients')
        ->select('*')
        ->where('id_commande_client',$id)
        ->delete();


       // dd($request);
        $qte = $request->get('quantite');
        $count = 0;
        $date = date('Y-m-d');
        $cat = $request->get('nom_cat');
        $client = $request->get('client');
        //dd($client);
    
        
        $order = 0;
        $cmd = 0;
        $p = $request->get('product');

       // dd($count);
       
        foreach ($p as $pro => $valeur){
        $count += $request->get('quantite_'.$valeur);
        }
        $total = $count;
        
        //enregistrer les données dans la table commande Client
        
        $c = new CommandeClient();
        $c->reference_commande = $id;
        $c->date_cmd_client = $date;
        $c->total_produits = $total;
        $c->id_client = $id_client;
        $c->etat_commande = 'en cours';
        $c->save();
       
       
        //enregistrer les données dans la table ligne de commande
        // dd($request);
        // dd($request->get('quantite_2'));
        $tva = 0; $ttc=0;
    
       foreach ($p as $prod => $val){
            $pr = new lignecommandesclient(); 
            $pr->id_produit = $val;
            $pr->id_commande_client = $id;
            $pr->quantite_cmd = $request->get('quantite_'.$val);
            $prix_vente = DB::select('select * from products where products.id = ?',[$val]);
            $prix = 0.0;
            foreach($prix_vente as $price){
                $prix = $price->prix_vente;
            }
            $quanti = $request->get('quantite_'.$val);
            $pr->prix_total = $prix * $quanti;
            $tva = round( 100 * $prix * (1 + 20 / 100) ) / 100;
            $ttc = $prix + $tva;
            $pr->total_tva = $tva;
            $pr->total_ttc = $ttc;
            $pr->save();
        }
    
       
    
      
       
         $lignescmd = DB::select('select * from lignecommandesclients , products
         where lignecommandesclients.id_produit = products.id
         AND  id_commande_client = ?',[$ref]);
          //calculer le prix total de la commande
          $total = 0;  
         foreach($lignescmd as $lignec){
             $price = $lignec->prix_vente;
             $quant = $lignec->quantite_cmd;
             $prixcmd = $price * $quant;
             $total += $prixcmd;
            
         }   
         //Enregistrer le total ttc tva dans la table commande client
       $cmd_client = DB::select('select * from lignecommandesclients where id_commande_client = ?',[$ref]);
       $ttc = 0.0;
       $tva = 0.0;
       foreach($cmd_client as $cmd){
        $t_ttc = $cmd->total_ttc;
        $ttc += $t_ttc;

        $t_tva = $cmd->total_tva;
        $tva += $t_tva;
       }

          $totalprice = $total;
          $update = DB::table('commande_clients')
          ->where('reference_commande', $ref)
          ->update(['prix_total' => $totalprice , 'total_ttc' => $ttc , 'total_tva' =>$tva]); 
    
         
        return redirect()->back()
        ->with('success','Commande updated successfully');
      

       
    }
    
        
      
        public function destroy($commande)
        {
            $res = CommandeClient::where('reference_commande',$commande)->delete();
    
            return redirect()->back();
        
       }
       public function listeBC(){
        $commandes = CommandeClient::get();
        $products = Product::get();
        $notifications = auth()->user()->unreadNotifications->count();
       
        return view('commandesC.listeBC',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('notif',$notifications);
    
    
       }
       public function enregistrer(Request $request){
        $ref = $request->get('ref');
        $etat = $request->get('etat');
        $commandes = CommandeClient::get();
        
        $e=""; $r="";
        if($ref != null){
        foreach ($ref as $val){
            $r = $val;
            $e = $request->get('etat_'.$val);
        }
    }
        //dd($e);
        $update = DB::table('commande_clients')
        ->where('reference_commande', $r)
        ->update(['etat_commande' => $e]); 
        /*return view('commandesC.listeBC')
        ->with('commandes',$commandes)
        ->with('success','commande updated successfully.');*/
        return redirect()->back()->with('message', 'Impossible d enregistrer la commande' );
                        
    }
    
       // Generate PDF
       public function createPDF($ref) {
           $date = date('y-m-d');
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
        view()->share('date',$date);
        view()->share('entreprise',$entreprise);
        view()->share('clients',$clients);
        view()->share('products',$products);
        $pdf = PDF::loadView('pdf_commande_client', $commandes);
          
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }
      
    public function categoryc(Request $request)
    {
        
        $commandes = CommandeClient::latest()->paginate(5);
        $categories = Categorie::get();
        $client = Client::get();
        $cat = $request->get('nom_cat');
       // dd($cat);
        $products = DB::select('select * from products where products.id_category =?',[$cat]);
        //$products = Product::get();
         // dd($request);
         $notifications = auth()->user()->unreadNotifications->count();
        return view('commandesC.index',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories',$categories)
            ->with('client',$client)
            ->with('products',$products)
            ->with('notif',$notifications);
    }

      // Generate PDF
      public function facturepdf($ref) {
          //la date
          $date = date('y-m-d');
          $fac_clients=facture_client::get();
          $facture = DB::select('select * from  facture_clients where
          id_commande_client = ?',[$ref]);
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
        view()->share('facture',$facture);
       
       
        $pdf = PDF::loadView('pdf_facture1', $commandes);
          
        // download PDF file with download method+67
        return $pdf->download('facture.pdf');
      }

      public function rechercher(Request $request){
        // Get the search value from the request
           $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $commandes = CommandeClient::query()
            ->where('reference_commande', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('commandesC.listeBC', compact('commandes'));
        
    }
    public function devipdf($ref) {
        //la date
        $date = date('y-m-d');
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
     
      $pdf = PDF::loadView('devi_pdf', $commandes);
        
      // download PDF file with download method+67
      return $pdf->download('devi.pdf');
    }
    }
    
    
    
