<?php

namespace App\Http\Controllers;
use App\Models\facture_client;
use App\Models\CommandeClient;
use DB;
use Illuminate\Http\Request;

class FactureClientController extends Controller
{
    
    public function index()
    {
       /* $commandes = commande_fournisseur::latest()->paginate(5);
    
        return view('commandesF.facture',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/
            $notifications = auth()->user()->unreadNotifications->count();
            $commande_clients=  CommandeClient::get();
            $fac_clients=facture_client::get();
            return view('commandesC/facture',compact('commande_clients'))
            ->with('fac_clients',$fac_clients)
            ->with('notif',$notifications);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_commande' => 'required',
            'date_facture' => 'required',
            'etat_facture' => 'required',
        ]);
        $user1 = DB::table('commande_clients')->where('reference_commande', $request->id_commande)->first();
        $c1=  DB::select('select commande_clients.id_client from commande_clients where commande_clients.reference_commande = ?',[$request->id_commande]);
        $fac_client=new facture_client();
        $fac_client->id_commande_client=$request->id_commande;
        $fac_client->date_facture=$request->date_facture;
        $fac_client->etat_facture=$request->etat_facture;
        $fac_client->id_client=$user1->id_client;
        $fac_client->save();
        return redirect()->route('factureclient.index')
        ->with('success','factureclient created successfully.');
    
    }
    public function save(Request $request){
        $ref = $request->get('ref');
        $etat = $request->get('etat');
        $factures = facture_client::get();
        
        $e=""; $r="";
        if($ref != null){
        foreach ($ref as $val){
            $r = $val;
            $e = $request->get('etat_'.$val);
        }
    }
        //dd($e);
        $update = DB::table('facture_clients')
        ->where('id', $r)
        ->update(['etat_facture' => $e]); 
        /*return view('commandesC.listeBC')
        ->with('commandes',$commandes)
        ->with('success','commande updated successfully.');*/
        return redirect()->back()->with('message', 'Impossible d enregistrer la commande' );
                        
    }
    public function bb(Request $request){

     

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
       return redirect()->back()->with('message', 'Impossible d enregistrer la commande' );
                        
    }
    
   
   
     
    
     

    
}
