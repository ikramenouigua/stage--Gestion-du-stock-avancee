<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxe;

class TaxeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:liste taxe|creer taxe|modifier taxe|supprimer taxe', ['only' => ['index','store']]);
        $this->middleware('permission:creer taxe', ['only' => ['create','store']]);
        $this->middleware('permission:modifier taxe', ['only' => ['edit','update']]);
        $this->middleware('permission:supprimer taxe', ['only' => ['destroy']]);
        
    }

    public function index(){
        $taxes = Taxe::latest()->paginate(1000);
        $notifications = auth()->user()->unreadNotifications->count();
        return view('taxe.index',compact('taxes'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('notif',$notifications);
      
    }
    public function create(){

    }
    public function store(Request $request){
        $request->validate([
            
            'nom_taxe'=> 'required',
            'valeur'=> 'required',

        ]);
        $taxe = new Taxe();
        $taxe->nom=$request->nom_taxe;
        $taxe->valeur=$request->valeur;
        $taxe->save();
        return redirect()->route('taxe.index')
                        ->with('success','taxe created successfully.');
    }
    public function edit(Taxe $taxe)
    {
         return view('taxe.edit',compact('taxe'));
    }

    public function update(Request $request, $id)
    {
        $taxe = Taxe::findOrFail($id);
        $taxe->nom = $request->nom;
        $taxe->valeur=$request->valeur;
        $taxe->save();
        return redirect()->route('taxe.index')
        ->with('success','taxe deleted successfully');
    }
     function destroy(Taxe $taxe)
    {

        $taxe->delete();
        return redirect()->route('taxe.index')
                        ->with('success','taxe deleted successfully');
    }
    //
}
