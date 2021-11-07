<?php
  
namespace App\Http\Controllers;
   
use App\Models\Fournisseur;
use Illuminate\Http\Request;
  
class FournisseursController extends Controller
{
    

    function __construct()
    {
         $this->middleware('permission:liste fournisseurs|creer fournisseur|modifier fournisseur|supprimer fournisseur', ['only' => ['index','show']]);
         $this->middleware('permission:ajouter fournisseur', ['only' => ['index','store']]);
         $this->middleware('permission:modifier fournisseur', ['only' => ['edit','update']]);
         $this->middleware('permission:supprimer fournisseur', ['only' => ['destroy']]);
         $this->middleware('permission:liste fournisseurs', ['only' => ['show']]);
        
    }
    
    public function index()
    {
        $fournisseurs = Fournisseur::latest()->paginate(5);
        $notifications = auth()->user()->unreadNotifications->count();
    
        return view('fournisseurs.index',compact('fournisseurs'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('notif',$notifications);
            
            
    }
    
    public function create()
    {
       
        return view('fournisseurs.create');
    }
    
   
    public function store(Request $request)
    {
        $request->validate([
            'nom_fournisseur'=> 'required',
            'email' => 'required',
            'tel' => 'required',
        ]);
    
        Fournisseur::create($request->all());
        return redirect()->route('fournisseur.index')
                        ->with('success','Fournisseur created successfully.');
    }
     
    
    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show',compact('fournisseur'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fournisseur  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
       return view('fournisseurs.edit',compact('fournisseur'));
    }
    
    
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom_fournisseur',
            'email',
            'tel' ,
        ]);
    
        $fournisseur->update($request->all());
    
        return redirect()->route('fournisseur.index')
                        ->with('success','Fournisseur updated successfully');
    }
    
  
    public function destroy(Fournisseur $fournisseur)
    {
      $fournisseur->delete();
    
        return redirect()->route('fournisseur.index')
                        ->with('success','Fournisseur deleted successfully');
    }
   }

