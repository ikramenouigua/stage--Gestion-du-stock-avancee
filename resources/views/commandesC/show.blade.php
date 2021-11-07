@extends('commandesc.layout')
  
@section('content')

<body class="commande">
      
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="titre2"> Détails de la commande</h2>
                <br/><br/>
            </div>
           
    <table id="dtVerticalScrollExample" cellspacing="0"
  width="100%" style=" color :black;
      border : 2px solid black;">
    <tr>
    <th class="th-sm">Référnce produit 
      </th>
      <th class="th-sm">le nom de client
      </th>
      <th class="th-sm">lébéllé de produit 
      </th>
      <th class="th-sm">Quantité commandée 
      </th>
      <th class="th-sm">prix de vente 
      </th>
     
    </tr>

  @foreach($lignes as $ligne)
  <tr>
      <td>{{$ligne->id_produit}}</td>
      <td>{{$name}}</td>
      <td>{{$ligne->libelle_produit}}</td>
      <td>{{$ligne->quantite_cmd}}</td>
      <td>{{$ligne->prix_vente}}</td>
    
    </tr>
   
</table>
<br/><br/> 
<h1 style="color:black;">le prix total est : {{$totalprice}} DH</h1>
<br/><br/> 
                <button type="button" class="btn btn-primary" id="btn">
                <a class="btn btn-primary" href="{{ route('commandeclient.createpdf',$ligne->id_commande_client) }}" id="btn">Export to PDF</a>
            
        </div>
        <br/><br/>
        @endforeach
</body>
@endsection