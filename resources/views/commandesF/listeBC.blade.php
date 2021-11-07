@extends('layouts.master')
 @section('content')
<body style="background-color : white;">
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="color:#0DB1B9;">Commande Expédition</h2>
        </div>
    </div>
</div>

<div class="main-container">
<!--<div style="margin-top:2%;">
<p>Rechercher</p><input type="text" name="search"></div> -->

 <!-- Search Widget -->
 <div class="card my-4">
        <h5 class="card-header">Search</h5>
         <form action="{{ route('search') }}" method="GET">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." name="search" required/>
                <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
            </div>
        </form> 
   
<form method="POST" action="{{ route('commande.enregistrer') }}">
@csrf

    </div><br/><br/>
     <table class="cont_div">
         <tr>
            <th>         </th>
             <th>Réference</th>
             <th>Total des produits</th>
             <th>Date de commande </th>
             <th>Prix total</th>
             <th >Etat du commande</th>
             <th width="280px">Modifier Etat du commande</th>
         </tr>
         @if($commandes->isNotEmpty())
         @foreach ($commandes as $commande)
         <tr>
         <td>
		<label class="checkbox-wrap checkbox-primary">
		 <input type="checkbox" name="ref[]" value="{{$commande->reference_commande}}">
		 <span class="checkmark"></span>
		</label>
		</td>
             <td>{{ $commande->reference_commande }}</td>
             <td>{{ $commande->quantite_cmd }}</td>
             <td>{{ $commande->date_cmd_fournisseur }}</td>
             <td>{{$commande->prix_total}}</td>
             <td>{{$commande->etat_commande}}</td>
             <td>
             <select name="etat_{{$commande->reference_commande}}">
             <option>en cours</option>
             <option>validée</option>
             <option>rejetée</option>
             </select>
            </td>
         </tr>
         @endforeach
         @else 
    <div>
        <h2>No commande found</h2>
    </div>
@endif
     </table>
     <br/<<br/>
     <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn">Modifier les etats</button>
        </div>
        </form>
        <br/<<br/<br/>
        <form method="POST" action="{{ route('commande.misajour') }}">
        @csrf
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn">mettre à jour le stocke</button>
        </div>
       </form>
        </body>
 @endsection