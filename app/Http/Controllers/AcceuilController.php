<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\commande_fournisseur;
use App\Models\CommandeClient;
use App\Models\Facture_fournisseurs;
use App\Models\Client;
use App\Models\facture_client;
use App\Models\User;

use Illuminate\Http\Request;

use DB;

class AcceuilController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:statistique|rapport vente|rapport achat|rapport client|affiche ventes|affiche achats|affiche clients|affiche factures', ['only' => ['liste']]);
         $this->middleware('permission:statistique', ['only' => ['index']]);
         $this->middleware('permission:rapport vente', ['only' => ['show_rapport']]);
         $this->middleware('permission:rapport achat', ['only' => ['show_rapport_achat']]);
         $this->middleware('permission:rapport client', ['only' => ['show_rapport_client']]);
         $this->middleware('permission:affiche ventes', ['only' => ['show_vente']]);
         $this->middleware('permission:affiche achats', ['only' => ['show_achat']]);
         $this->middleware('permission:affiche clients', ['only' => ['show_clients']]);
         $this->middleware('permission:affiche factures', ['only' => ['show_facture']]);
    }
       
    public function index(){
        
        $notifications = auth()->user()->unreadNotifications->count();
        $categories = DB::table('categories')->count();
        $products =   DB::table('products')->count();
        $fournisseurs = DB::table('fournisseurs')->count();
        $clients = DB::table('clients')->count();
        $fac1 = DB::table('facture_clients')->count();
        $fac2 = DB::table('facture_fournisseurs')->count();
        $fac=$fac1+$fac2;
        $commande_clients=DB::table('commande_clients')->count();
        $commande_fournisseurs=DB::table('commande_fournisseurs')->count();

      
        $cmds=CommandeClient::get();
        
       
      
    return view('dashboard')  
    
        ->with('products',$products)
        ->with('fournisseurs',$fournisseurs)
        ->with('clients',$clients)
        ->with('categories',$categories)
        ->with('commande_clients',$commande_clients)
        ->with('fac',$fac)
        ->with('commande_fournisseurs',$commande_fournisseurs)
        ->with('notif',$notifications);
    }
    public function show_rapport(){

        $notifications = auth()->user()->unreadNotifications->count();
        $filter=CommandeClient::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%Y %m %e') as date")->groupBy('date')->get();
        $record=[1,2,3];
        $data=null;
        foreach($filter as $f) {
            $data['data'][]= (int) $f->count;
            $data['label'][] = $f->date;
           
          }
     
        $data['chart_data'] = json_encode($data);
       
       
    return view('rapport.vente',$data) 
    ->with('notif',$notifications);
    }
    public function show_rapport_achat(){
        $notifications = auth()->user()->unreadNotifications->count();
        $filter=commande_fournisseur::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%Y %m %e') as date")->groupBy('date')->get();
        $record=[1,2,3];
        $data=null;
        foreach($filter as $f) {
            $data['data'][]= (int) $f->count;
            $data['label'][] = $f->date;
           
          }
     
        $data['chart_data'] = json_encode($data);
       
       
    return view('rapport.achat',$data) 
    ->with('notif',$notifications);
    }
    public function show_rapport_client(){
        $notifications = auth()->user()->unreadNotifications->count();
        $filter=Client::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%Y %m %e') as date")->groupBy('date')->get();
        $record=[1,2,3];
        $data=null;
        foreach($filter as $f) {
            $data['data'][]= (int) $f->count;
            $data['label'][] = $f->date;
           
          }
     
        $data['chart_data'] = json_encode($data);
       
       
    return view('rapport.achat',$data) 
    ->with('notif',$notifications);
    }
    
    public function show_vente(){
        $notifications = auth()->user()->unreadNotifications->count();
        $co_clients = CommandeClient::latest()->paginate(1000);
        return view('accueil/vente',compact('co_clients'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('notif',$notifications);
    }
    public function show_achat(){
        $notifications = auth()->user()->unreadNotifications->count();
        $co_fournisseurs = commande_fournisseur::latest()->paginate(1000);
        return view('accueil/achat',compact('co_fournisseurs'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('notif',$notifications);
    }
    public function show_clients(){
        $notifications = auth()->user()->unreadNotifications->count();
        $clients = Client::latest()->paginate(1000);
        return view('accueil/clients',compact('clients'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('notif',$notifications);
    }
    public function show_facture(){
        $notifications = auth()->user()->unreadNotifications->count();
        $factures = Facture_fournisseurs::latest()->paginate(1000);
        $cli_factures = facture_client::latest()->paginate(1000);
        return view('accueil/facture',compact('factures'))
        ->with('cli_factures',$cli_factures)
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('notif',$notifications);
    }
}
