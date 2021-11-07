<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Caracteristique;
use DB;

class CaracteristiqueController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        function __construct()
        { 
            $this->middleware('permission: ajouter caracteristique|modifier caracteristique|supprimer caracteristique', ['only' => ['index','show']]);
            $this->middleware('permission:ajouter caracteristique', ['only' => ['index','store']]);
            $this->middleware('permission:modifier caracteristique', ['only' => ['edit','update']]);
            $this->middleware('permission:liste caracteristique', ['only' => ['show']]);
            $this->middleware('permission:supprimer caracteristique', ['only' => ['destroy']]);
        }
         
        public function index()
        {             
            $notifications = auth()->user()->unreadNotifications->count();          
            $caracteristiques = Caracteristique::latest()->paginate(1000);
            $products = Product::get();
           
            return view('caracteristiques.index',compact('caracteristiques'))
                ->with('products',$products)
                ->with('i', (request()->input('page', 1) - 1) * 5)
                ->with('notif',$notifications);
        }
         
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
           
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $request->validate([
                'ref_produit',
                'couleur',
                'taille',
                'reference',
            ]);
              $id = $request->get('ref_produit');
              $couleur = $request->get('couleur');
              $taille = $request->get('taille');

             $ref = DB::select('select * from products where products.ref_produit = ? ',[$id]);
            $r = 0;
            $reference = "";
            foreach($ref as $val){
                $r = $val->id;
                $reference = $val->ref_produit;
            }
           // dd($r);
           $c = new Caracteristique(); 
           $c->ref_produit = $r;
           $c->couleur = $couleur;
           $c->taille = $taille;
           $c->reference = $reference;
           $c->save();
            return redirect()->route('caracteristiques.index')
                            ->with('success','Caracteristique created successfully.');
        }
         
        /**
         * Display the specified resource.
         *
         * @param  \App\Caracteristique  $product
         * @return \Illuminate\Http\Response
         */
        public function show($c)
        {   $caracter = DB::select('select * from caracteristiques where id =?',[$c]);
            //dd($caracter);
            $notifications = auth()->user()->unreadNotifications->count();
            return view('caracteristiques.show',compact('caracter'))
            ->with('notif',$notifications);
        }
         
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Caracteristique  $product
         * @return \Illuminate\Http\Response
         */
        public function edit(Caracteristique $caracter)
        {
            $caracteristiques = Caracteristique::get();
            return \View::make('caracteristiques.edit', [
                'caracteristiques' => $caracteristiques ,'caracter' => $caracter
            ]);
            
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Caracteristique  $product
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Caracteristique $caracter)
        {
            $request->validate([
                'ref_produit',
                'couleur',
                'taille',
                'reference',
            ]);
        
            $caracter->update($request->all());
        
            return redirect()->route('caracteristiques.index')
                            ->with('success','Product updated successfully');
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         */
        public function destroy(Caracteristique $caracteristique)
        {
            $caracteristique->delete();
        
            return redirect()->route('caracteristiques.index')
                            ->with('success','Product deleted successfully');
        }
    
        public function caracteristique(){
            $product = Product::get();
            return \View::make('products.caracteristique', [
                'product' => $product
            ]);
        }
        public function store_caracteristique(){
            $request->validate([
                
            ]);
        
            Product::create($request->all());
            $notifications = auth()->user()->unreadNotifications->count();
            return view('products.caracteristique')
                            ->with('success','Product created successfully.')
                            ->with('notif',$notifications);
        }
    
    
}
