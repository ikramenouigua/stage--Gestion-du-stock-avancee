@extends('layouts.master')

@section('content')
<br><br>
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
   
<form action="{{ route('factureclient.store') }}" method="POST">
    @csrf
    <div class="main-container">
    <h1 style="color:blue;">Facture</h1>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Choisir la commande:</strong>
                <select type="text" name ="id_commande"  class="form-control" required>
					   @foreach($commande_clients as $commande_client)
				   <option value="{{$commande_client->reference_commande}}">{{$commande_client->reference_commande}}</option>
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
                <button type="submit" class="btn btn-primary">Enregistrer la facture</button>
        </div>
        </form>
        <form method="POST" action="{{ route('change_facture') }}">
@csrf
  <table class="cont_div">
      <tr>
      <th>         </th>
        <th>Numéro du facture</th>
        <th>Réference du commande </th>
        <th>Date facture</th>
        <th>etat du facture</th>
        <th>modifier etat</th>
        

      </tr>
      @foreach($fac_clients as $fac_client)
      <tr>
      <td>
		<label class="checkbox-wrap checkbox-primary">
		 <input type="checkbox" name="ref[]" value="{{$fac_client->id}}">
		 <span class="checkmark"></span>
		</label>
        <td>{{$fac_client->id}}</td>
        <td>{{$fac_client->id_commande_client}}</td>
        <td>{{$fac_client->date_facture}}</td>
        <td>{{$fac_client->etat_facture}}</td>
        <td> <select name="etat_{{$fac_client->etat_facture}}">
             <option >paye</option>
             <option >non paye </option>
             </select></td>
        <td style="width: 150px;">
        <a class="btn btn-info" href=""><i class="fas fa-eye"></i>
                    </a>
       
        
        <a class="btn btn-primary" href="{{route('commandec.facturepdf',$fac_client->id_commande_client)}}"><i class="fas fa-file-pdf"></i></a>
      

   
      
   
  

            </td>
      </tr>
      @endforeach
  </table>
  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn">Modifier les etats</button>
        </div>
        </form>
</div>
</body>


@endsection