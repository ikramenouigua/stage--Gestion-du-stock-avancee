<!DOCTYPE html>
<html>
<head>
  <title>Bonde de livraison</title>
  <style>
h1{
margin-left:50px;
  
}
header
{

position: relative;

}
#logo
{
margin-left:0;
width:80px;
height:80px;
}
.date{
  position: absolute;
right:0;
top:0;
}
label{
  margin-top:30px;
  border:black 1px solid ;
  width:90px;
}
#fin{
  color:gray;
}
</style>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="margin-top: 15px ">
        <div class="pull-left">
            
              <header>
              @foreach($entreprise as $e)
              <img src="{{public_path('images/').$e->logo}}" id="logo">
              <p class="date">Le : 		{{$date}}</p>
               </header>
              <div >
             <p id="fin">Nom de société : {{$e->nom}} <br/>
               Address  <br/>
               CP ville  <br/>
               Téléphone  </p>
      
            @endforeach
    </div>
   
  
    <div style=" width:200px; height:80px;">
       <div style=" margin-top:1px; position: absolute;
         right:0;
          top:150px;">
          @foreach($clients as $cli)
*             <p>Nom du client : {{$cli->nom}}
                <p>Adresse: {{$cli->address1}}</p>
               <p> CP Ville</p> 
               @endforeach
         </div>

</div>
@foreach($commandes as $cmd)
       <h1>  Bonde de livraison N {{$cmd->id}}</h1>
       <hr/>
       <br/>
       <p> N°Client : {{$cmd->id_client}} <br/>
          N°Commande : {{$ref }} </p>
    @endforeach
   
        </div>
      
        </div> 
      </div>
    </div><br>
    <div style="margin-top:10px;">
    <table style="border:2px solid;">
      <tr style="background-color:#0DB1B9;">
        <th>Référence</th>
        <th>Libéllé du produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
        <th>Total TVA</th>
        <th>Total TTC</th>
      </tr>

    @foreach($products as $l)
      <tr>
        <td>{{$l->id_produit}}</td>
        <td>{{$l->libelle_produit}}</td>
        <td>{{$l->qte}}</td>
        <td>{{$l->prix_vente}}</td>
        <td>{{$l->prix_total}}</td>
        <td>{{$l->total_tva}}</td>
        <td>{{$l->total_ttc}}</td>
      </tr>
      @endforeach
    </table>
    <br/><br/>
    @foreach($commandes as $c)
   <p> Total Hors Taxe	    {{$c->prix_total}}</p> 
  <p>TVA à 20%	         {{$c->total_tva}} </p> 
<p>Total TTC en Dirhams   	{{$c->total_ttc}} </p> 
@endforeach
<br/><br/>
    </div>
   
      
     
</div>


        </body>
</html> 



