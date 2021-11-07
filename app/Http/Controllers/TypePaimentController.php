<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypePaiment;

class TypePaimentController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:liste type_paiement|creer type_paiement|modifier type_paiement|supprimer type_paiement', ['only' => ['index','store']]);
        $this->middleware('permission:creer type_paiement', ['only' => ['create','store']]);
        $this->middleware('permission:modifier type_paiement', ['only' => ['edit','update']]);
        $this->middleware('permission:supprimer type_paiement', ['only' => ['destroy']]);
        
    }

    public function index(){
        $notifications = auth()->user()->unreadNotifications->count();
        $paiements = TypePaiment::latest()->paginate(1000);
    
        return view('paiement.index',compact('paiements'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('notif',$notifications);
      
    }
    public function create(){

    }
    public function store(Request $request){
        $request->validate([
            
           
            'valeur'=> 'required',

        ]);
        $paiement = new TypePaiment();
        $paiement->type=$request->valeur;
        $paiement->save();
        return redirect()->route('paiement.index')
                        ->with('success','taxe created successfully.');
    }
    public function edit(TypePaiment $paiement)
    {
         return view('paiement.edit',compact('paiement'));
    }

    public function update(Request $request, $id)
    {
        $paiement = TypePaiment::findOrFail($id);
        $paiement->type = $request->type;
        $paiement->save();
        return redirect()->route('paiement.index')
        ->with('success','paiement updated successfully');
    }
     function destroy(TypePaiment $paiement)
    {

        $paiement->delete();
        return redirect()->route('paiement.index')
                        ->with('success','paiement deleted successfully');
    }
}
