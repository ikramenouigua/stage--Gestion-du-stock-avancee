<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lignecommande;
class LigneCommandeController extends Controller
{
   
    public function index()
    {
        /*$commandes = commande_fournisseur::latest()->paginate(5);
    
        return view('commandesF.index',compact('commandes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/
            
            
    }
    
    public function create()
    {
     /* $commandes = Fournisseur::get();
      $products = Product::get();
      return \View::make('commandesF.create', [
          'commandes' => $commandes, 'products'=>$products
      ]);*/
       
       //return view('commandesF.create');
    }
    
   
     
    public function store(Request $request)
    {
       
    }
     
    
    public function show(Lignecommande $ligne)
    {
        return view('commandesF.show',compact('ligne'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fournisseur  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(CommandeFournisseur $commande)
    {
       //return view('products.edit',compact('product'));
    }
    
    
    public function update(Request $request, CommandeFournisseur $commande)
    {
      /*  $request->validate([
            'id' => 'required',
            'libelle_produit' => 'required',
            'unite_produit',
            'quantite',
            'stocke_min',
            'prix_achat',
            'prix_vente',
            'id_category',
            'image_produit',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');*/
    }
    
  
    public function destroy(CommandeFournisseur $commande)
    {
     /*   $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }*/
   }
}


