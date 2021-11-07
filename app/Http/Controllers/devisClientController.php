<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandeClient;

class devisClientController extends Controller
{
    //
    public function show()
    {
       /* $commandes = commande_fournisseur::latest()->paginate(5);
    
        return view('commandesF.facture',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/
            $commande_clients=  CommandeClient::get();
            $notifications = auth()->user()->unreadNotifications->count();
            
            return view('devisClient/index',compact('commande_clients'))
            ->with('notif',$notifications);
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
