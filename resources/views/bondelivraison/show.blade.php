@extends('bondelivraison.layout')
  
@section('content')

<body class="commandebl">
      
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="titre2"> Détails de la bonde de livraison</h2>
                <br/><br/>
            </div>
           
    <table id="dtVerticalScrollExample" cellspacing="0"
  width="100%" style=" color :black;
      border : 2px solid black;">
    <tr>
    <th class="th-sm">Référnce produit 
      </th>
      <th class="th-sm" style="background-color:white;">Libéllé de produit 
      </th>
      <th class="th-sm">Prix de vente 
      </th>
      <th class="th-sm">Quantité
      </th>
      <th class="th-sm">Prix total
      </th>
      <th class="th-sm">Prix ttc
      </th>
      <th class="th-sm">prix tva
      </th>
     
    </tr>

  @foreach($infos as $info)
  <tr>
      <td>{{$info->id_produit}}</td>
      <td  style="background-color:white;">{{$info->libelle_produit}}</td>
      <td>{{$info->prix_vente}}</td>
      <td>{{$info->qte}}</td>
      <td>{{$info->prix_total}}</td>
      <td>{{$info->total_ttc}}</td>
      <td>{{$info->total_tva}}</td>
    </tr>
    @endforeach
</table>
<br/><br/> 
              
        </div>
        <br/><br/>
        
</body>
@endsection