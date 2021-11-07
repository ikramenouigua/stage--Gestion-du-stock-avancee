<?php

namespace App\Http\Controllers;
use App\Models\commande_fournisseur;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Lignecommande;
use App\Models\Setting;
use App\Models\Entreprise;
use App\Models\Stocke;
use App\Models\Avoire_F;
use App\Models\facture_fournisseurs;
use Illuminate\Http\Request;
use DB;
use PDF;
class CommandeFournisseurController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:listeBC commandeF|commandeF-create|commandeF-edit|commandeF-delete|commandeF-createPDF', ['only' => ['index','listBC']]);
        $this->middleware('permission:creer commandeF', ['only' => ['create','store']]);
        $this->middleware('permission:modifier commandeF', ['only' => ['edit','update']]);
        $this->middleware('permission:supprimer commandeF', ['only' => ['destroy']]);
        $this->middleware('permission:creerPDF commandeF', ['only' => ['createPDF']]);
        $this->middleware('permission:listeBC commandeF', ['only' => ['listBC']]);
   }
    

    public function index(Request $request)
    {
    $notifications = auth()->user()->unreadNotifications->count();   
    $commandes = commande_fournisseur::latest()->paginate(5);
    $commandes_F = Fournisseur::get();
    $categories = Categorie::get();
    $products = Product::get();
    return view('commandesF.index',compact('commandes'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('commandes_F',$commandes_F)
        ->with('categories',$categories)
        ->with('products',$products)
        ->with('notif',$notifications);
    }
    
    public function create()
    {
      $notifications = auth()->user()->unreadNotifications->count();
      $commandes_F = Fournisseur::get();
      $commandes = commande_fournisseur::get();
      $products = Product::get();
      $categories = Categorie::get();
      return \View::make('commandesF.index', [
          'commandes' => $commandes, 'products'=> $products,'commandes_F'=>$commandes_F,'categories' =>$categories
      ])
      ->with('notif',$notifications);
       
       //return view('commandesF.create');
    }
    
   
    public function store(Request $request)
    {
        $qte = $request->get('quantite');
        $id_fourni = $request->get('id_fournisseur');
        $count = 0;
        $date = date('Y-m-d');
        $commande = $request->get('id');

      $request->validate([
            'date_cmd_fournisseur',
            'total_produits',
            'reference_commande',
            'id_fournisseur',
            'id_commande_fourni',
            'id_produit',
            'quantite_cmd',
            'prix_total',
            'etat_commande',
        ]);
        //find prifix commande
        $settings = DB::select('select * from settings');
        $prefix="";
        $order = 0;
        $cmd = 0;
        foreach($settings as $s){
            $prefix = $s->prefix;
            $order = $s->order;
        }
        $ref = $prefix . $order;
        $p = $request->get('product');

       // dd($count);
      if($p !=null){
       foreach ($p as $pro => $valeur){
        $count += $request->get('quantite_'.$valeur);
        $prix_total=$request->get('quantite_'.$valeur)*$request->get('prix_'.$valeur);
       }
        $total = $count;
        //enregistrer les données dans la table commande fournisseur
        $c = new Commande_fournisseur();
        $c->reference_commande = $ref;
        $c->date_cmd_fournisseur = $date;
        $c->total_produits = $total;
        $c->id_fournisseur = $id_fourni;
        $c->etat_commande = 'en cours';
        $c->prix_total=$prix_total;
        $c->save();
       
       

        foreach ($p as $prod => $val){
            $pr = new Lignecommande(); 
            $pr->id_produit = $val;
            $pr->id_commande_fourni = $ref;
            $pr->quantite_cmd = $request->get('quantite_'.$val);
            $prix_vente = DB::select('select * from products where products.id = ?',[$val]);
            $prix = 0.0;
            foreach($prix_vente as $price){
                $prix = $price->prix_vente;
            }
            $quanti = $request->get('quantite_'.$val);
            $pr->prix_total = $prix * $quanti;
            $pr->save();
        }

    }
       /* $stocke = 0;
             foreach($p as $qu => $valeur){
             $productquantite = DB::select('select products.quantite from products where products.id = ?',[$valeur]);
              $quantiteoriginal = 0;
             foreach($productquantite as $quantite){
                $quantiteoriginal = $quantite->quantite;
            }
            $stocke = $quantiteoriginal + $qte[$qu];
            $update = DB::table('products')
            ->where('products.id', $p)
            ->update(['quantite' => $stocke]); 
       }*/
    
        DB::table('settings')->increment('order');
      
        /*return redirect()->route('commande.create')
        ->with(['success'=>'Commande created successfully.']);*/
         //
         $lignescmd = DB::select('select * from lignecommandes , products
         where lignecommandes.id_produit = products.id
         AND  id_commande_fourni = ?',[$ref]);
          //calculer le prix total de la commande
          $total = 0;  
         foreach($lignescmd as $lignec){
             $price = $lignec->prix_vente;
             $quant = $lignec->quantite_cmd;
             $prixcmd = $price * $quant;
             $total += $prixcmd;
         }   
          $totalprice = $total;
          $update = DB::table('commande_fournisseurs')
          ->where('reference_commande', $ref)
          ->update(['prix_total' => $totalprice]); 
         
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
        $avoir = new Avoire_F();
        $avoir->date_avoire = $date;
        $avoir->numero_commande = $ref;
        $avoir->nom_fournisseur = Fournisseur::find($id_fourni)->nom_fournisseur ;
        $avoir->save();
      
        //return redirect()->back()->with('message', 'Commande created successfully!' );
        $commandes = commande_fournisseur::latest()->paginate(5);
        $commandes_F = Fournisseur::get();
        $categories = Categorie::get();
        $products = Product::get();
        $notifications = auth()->user()->unreadNotifications->count();
        return view('commandesF.index',compact('commandes'))
            ->with('commandes_F',$commandes_F)
            ->with('categories',$categories)
            ->with('products',$products)
            ->with('notif',$notifications);
            
    }
     
    public function show($ligne)
    { 
        //$cmd = commande_fournisseur::find($ligne);
       // dd($cmd->lignes);
     //sélectionner les détails de la commande
      $lignes = DB::select('select * from lignecommandes , products
      where lignecommandes.id_produit = products.id
       AND  id_commande_fourni = ?',[$ligne]);
     
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
      $nom = DB::select('select * from fournisseurs, commande_fournisseurs where fournisseurs.id = commande_fournisseurs.id_fournisseur AND commande_fournisseurs.reference_commande=?',[$ligne]);
      $name="";
      foreach($nom as $n){
       $name = $n->nom_fournisseur;
      }
      $notifications = auth()->user()->unreadNotifications->count();
      //Envoyer les données à la vue
      return view('commandesF.show',['lignes'=>$lignes, 'totalprice' =>$totalprice, 'name'=>$name])
      ->with('notif',$notifications);
    }
     
    /**
     * Show the form for editing the specified resource.
     *0
     * @param  \App\Lignecommande  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commandes = $id;
        $product = Product::get();
        $commandes_F = Fournisseur::get();
        $categories = Categorie::get();
        $lignes = DB::select('select * from lignecommandes,products where lignecommandes.id_produit = products.id and lignecommandes.id_commande_fourni=?',[$id]);
        //dd($lignes);
        $notifications = auth()->user()->unreadNotifications->count();
        return view('commandesF.edit',compact('commandes','product','lignes','commandes_F','categories'))
        ->with('notif',$notifications);
  
    }
    
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'id_commande_fourni',
            'id_produit',
            'quantite_cmd',
            'prix_total',
            
        ]);
        $ids = DB::select('select * from commande_fournisseurs where reference_commande =?',[$id]);
        $id_fourni = 0;
        $ref='';
        $dat='';
        foreach($ids as $i){
            $id_fourni = $i->id_fournisseur;
            $ref = $i->reference_commande;
            $dat = $i->date_cmd_fournisseur;
        }
       
        $p = $request->get('product');
        $date = date('Y-m-d');
        $c = DB::table('commande_fournisseurs')
        ->select('*')
        ->where('reference_commande',$id)
        ->delete();
         $l = DB::table('lignecommandes')
        ->select('*')
        ->where('id_commande_fourni',$id)
        ->delete();
        //return route('commande.store');

         //enregistrer les données dans la table commande fournisseur
         $count = 0;
         foreach ($p as $pro => $valeur){
            $count += $request->get('quantite_'.$valeur);
           }
            $total = $count;

         $c = new Commande_fournisseur();
         $c->reference_commande = $id;
         $c->date_cmd_fournisseur = $dat;
         $c->total_produits = $total;
         $c->id_fournisseur = $id_fourni;
         $c->etat_commande = 'en cours';
         $c->save();
        
        if($p !=null){
            foreach ($p as $pro => $valeur){
             $count += $request->get('quantite_'.$valeur);
            }
             $total = $count;
            
            
     
             foreach ($p as $prod => $val){
                 $pr = new Lignecommande(); 
                 $pr->id_produit = $val;
                 $pr->id_commande_fourni = $id;
                 $pr->quantite_cmd = $request->get('quantite_'.$val);
                 $prix_vente = DB::select('select * from products where products.id = ?',[$val]);
                 $prix = 0.0;
                 foreach($prix_vente as $price){
                     $prix = $price->prix_vente;
                 }
                 $quanti = $request->get('quantite_'.$val);
                 $pr->prix_total = $prix * $quanti;
                 $pr->save();
             }
     
         }
         $totalprice = $total;
         $update = DB::table('commande_fournisseurs')
         ->where('reference_commande', $id)
         ->update(['prix_total' => $totalprice]); 

        return redirect()->back()
        ->with('success','Commande updated successfully')
        ->with('notif',$notifications);
       /* $p = $request->get('product');
       
        foreach ($p as $prod => $val){
            $pr = new Lignecommande(); 
            $pr->id_produit = $val;
            $pr->id_commande_fourni = $commandes;
            $pr->quantite_cmd = $request->get('quantite_'.$val);
            $prix_vente = DB::select('select * from products where products.id = ?',[$val]);
            $prix = 0.0;
            foreach($prix_vente as $price){
                $prix = $price->prix_vente;
            }
            $quanti = $request->get('quantite_'.$val);
            $pr->prix_total = $prix * $quanti;
            $pr->save();
        }*/

       
    }
    
  
    public function destroy($commande)
    {
        
       $res=commande_fournisseur::where('reference_commande',$commande)->delete();
    
       return redirect()->back();
    }
   
   public function listeBC(){
    $commandes = commande_fournisseur::latest()->paginate(1000);
    $products = Product::get();
    $notifications = auth()->user()->unreadNotifications->count();
    return view('commandesF.listeBC',compact('commandes'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('notif',$notifications);


   }
   public function enregistrer(Request $request){

     

    $ref = $request->get('ref');
    $etat = $request->get('etat');
    $commandes = commande_fournisseur::get();
    
    $e=""; $r="";
    if($ref != null){
    foreach ($ref as $val){
        $r = $val;
        $e = $request->get('etat_'.$val);
    }
}
    //dd($e);
    $update = DB::table('commande_fournisseurs')
    ->where('reference_commande', $r)
    ->update(['etat_commande' => $e]); 

 

   //********** */
   $notifications = auth()->user()->unreadNotifications->count();
    return view('commandesF.listeBC')
    ->with('commandes',$commandes)
    ->with('success','commande updated successfully.')
    ->with('notif',$notifications);
                    
}

   // Generate PDF
   public function createPDF($ref) {
    $date = date('Y-m-d');
    // retreive all records from db
    $entreprise = Entreprise::get();
    $data = DB::select('select * from lignecommandes, products where  lignecommandes.id_produit = products.id and id_commande_fourni =? ',[$ref]);
    $commandes = DB::select('select * from commande_fournisseurs,fournisseurs where commande_fournisseurs.id_fournisseur = fournisseurs.id and reference_commande =?',[$ref]);
    
    // share data to view
    view()->share('data',$data);
    view()->share('commandes',$commandes);
    view()->share('date',$date);
    view()->share('entreprises',$entreprise);
    $pdf = PDF::loadView('pdf_view', $data);
      
    // download PDF file with download method
    return $pdf->download('pdf_file.pdf');
  }
  //serch
      public function search(Request $request){
    // Get the search value from the request
       $search = $request->input('search');

    // Search in the title and body columns from the posts table
    $commandes = commande_fournisseur::query()
        ->where('reference_commande', 'LIKE', "%{$search}%")
        ->get();

    // Return the search view with the resluts compacted
    return view('commandesF.listeBC', compact('commandes'));
    
}
public function category(Request $request)
{
    
    $commandes = commande_fournisseur::latest()->paginate(5);
    $commandes_F = Fournisseur::get();
    $categories = Categorie::get();
    $cat = $request->get('nom_cat');
   // dd($cat);
    $products = DB::select('select * from products where products.id_category =?',[$cat]);
    //$products = Product::get();
     // dd($request);
     $notifications = auth()->user()->unreadNotifications->count();
    return view('commandesF.index',compact('commandes'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('commandes_F',$commandes_F)
        ->with('categories',$categories)
        ->with('products',$products);
}
public function misajour(){
     //ajouter les commandes valides au stocke
   $et="validée";
   $bd = DB::select('select * from commande_fournisseurs where etat_commande=?',[$et]);
   $reference = "";
   foreach($bd as $val){
       $reference = $val -> reference_commande;
       $ligne=DB::select('select * from lignecommandes where id_commande_fourni=?',[$reference]);
       foreach($ligne as $l){
         //  dd($l);
        $id = $l->id_produit;
        $quantite = $l->quantite_cmd;
        $products = DB::select('select * from products where id = ?',[$id]);
        foreach($products as $p){
            $qte = $p->quantite;
            $total = $qte + $quantite;
            $modifier = DB::table('products')
            ->where('id', $id)
            ->update(['quantite' => $total]); 
            $total = 0;
        }
        
       }
    
        //remplir la table stocke
        $stocke_initiale = 0;
        $ref_product = '';
        foreach ($products as $produit){
            $ref= $produit->id;
            $stocke_initiale = $produit->stocke;
            $ref_product = $produit->ref_produit;  
             $entree = $produit->quantite;
        $date = date('y-m-d');
        $stocke = new Stocke();
        $stocke->date_entree = $date;
        $stocke->ref_cmd = $reference;
        $stocke->Référence_produit = $ref;
        $stocke->ref_produit = $ref_product;
        $stocke->stocke_initial = $stocke_initiale;
        $stocke->entree = $entree ;
        $stocke->save();
         
       
   }
   $notifications = auth()->user()->unreadNotifications->count();
   $commandes = commande_fournisseur::get();
   return view('commandesF.listeBC')
    ->with('commandes',$commandes)
    ->with('success','commande updated successfully.');
}
}
public function facturepdf($ref) {
    //la date
    $date = date('y-m-d');
    $fac_clients=facture_fournisseurs::get();
    $facture = DB::select('select * from  facture_fournisseurs where
    id_commande_fourni = ?',[$ref]);
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
  view()->share('facture',$facture);
 
 
  $pdf = PDF::loadView('facturePDF_F', $commandes);
    
  // download PDF file with download method+67
  return $pdf->download('facture.pdf');
}


}


