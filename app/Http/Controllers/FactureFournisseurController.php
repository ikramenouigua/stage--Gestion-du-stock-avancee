<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\commande_fournisseur;

use App\Models\Facture_fournisseurs;
use DB;

class FactureFournisseurController extends Controller
{


    public function index()
    {
       /* $commandes = commande_fournisseur::latest()->paginate(5);
    
        return view('commandesF.facture',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/
            $notifications = auth()->user()->unreadNotifications->count();
            $commande_fournisseurs=  commande_fournisseur::get();
            $fac_fournisseurs=Facture_fournisseurs::get();
            return view('commandesF/facture',compact('commande_fournisseurs'))
            ->with('fac_fournisseurs',$fac_fournisseurs)
            ->with('notif',$notifications);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_commande' => 'required',
            'date_facture' => 'required',
            'etat_facture' => 'required',
        ]);
        $user1 = DB::table('commande_fournisseurs')->where('reference_commande', $request->id_commande)->first();
        $c1=  DB::select('select commande_fournisseurs.id_fournisseur from commande_fournisseurs where commande_fournisseurs.reference_commande = ?',[$request->id_commande]);
        $fac_fournisseur=new Facture_fournisseurs();
        $fac_fournisseur->id_commande_fourni=$request->id_commande;
        $fac_fournisseur->date_facture=$request->date_facture;
        $fac_fournisseur->etat_facture=$request->etat_facture;
        $fac_fournisseur->id_fournisseur=$user1->id_fournisseur;
        $fac_fournisseur->save();
        return redirect()->route('facturefournisseur.index')
        ->with('success','facturefournisseur created successfully.');
    
    }
    
   
   
     
    public function show($ligne)
    { 
        
      
      
    }
     

    public function edit(CommandeFournisseur $commande)
    {
       
    }
    
    
    public function update(Request $request, CommandeFournisseur $commande)
    {
    }
    
    
  
    public function destroy(CommandeFournisseur $commande)
    {
    
    }

}
