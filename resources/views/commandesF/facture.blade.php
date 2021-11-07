@extends('layouts.master')

@section('content')
<body style="background-color:white">
        @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Il y'a certain problems avec les données entrées<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('facturefournisseur.store') }}" method="POST">
    @csrf
    <div class="main-container">
    <h1 style="color:blue;">Facture</h1>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Choisir la commande:</strong>
                <select type="text" name ="id_commande"  class="form-control" required>
					   @foreach($commande_fournisseurs as $commande_fournisseur)
				   <option value="{{$commande_fournisseur->reference_commande}}">{{$commande_fournisseur->reference_commande}}</option>
				    @endforeach
                     </select>
               
            </div>
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date facture:</strong>
                <input type="date" name="date_facture" class="form-control" placeholder="Référence">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <strong>Etat de facture:</strong>
                <select name="etat_facture" class="form-control" >
                <option name="paye">payé</option>
                <option name="non paye">non payé</option>
                </select>
            </div>
            <br/<<br/>
     <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Enregistrer jjjla facture</button>
        </div>

  <table class="cont_div">
      <tr>
     
        <th>Numéro du facture</th>
        <th>Réference du commande </th>
        <th>Date facture</th>
        <th>etat du facture</th>
        

      </tr>
      @foreach($fac_fournisseurs as $fac_fournisseur)
      <tr>
        <td>{{$fac_fournisseur->id}}</td>
        <td>{{$fac_fournisseur->id_commande_fourni}}</td>
        <td>{{$fac_fournisseur->date_facture}}</td>
        <td>{{$fac_fournisseur->etat_facture}}</td>
        <td style="width: 150px;">
        
                    <a class="btn btn-info" href=""><i class="fas fa-eye"></i>
                    </a>
       
        
        <a class="btn btn-primary" href="{{route('commande.facturepdf',$fac_fournisseur->id_commande_fourni)}}"><i class="fas fa-file-pdf"></i></a>
      

            </td>
      </tr>
      @endforeach
  </table>
</div>
</body>


@endsection