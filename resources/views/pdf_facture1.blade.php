<!DOCTYPE html>
<html>
<head>
  <title>Facture Proforma</title>
  <style>
h1{
background-color: #0DB1B9;
width:300px;
position: absolute;
right:0;
top:0;
  
}
header
{

position: relative;

}
#logo
{
margin-left:0;
width:150px;
height:150px;
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
              @foreach($facture as $f)
                <h1 >Facture  {{$f->id}}</h1>
                @endforeach 
               </header>

             <p>Nom de société : {{$e->nom}}<br/>
               RABAT <br/>
               44220 <br> 
               0625148788 <p>
            @endforeach
            </div>
    
    <div style="background-color:#0DB1B9; width:200px; height:110px;">
   
    @foreach($facture as $f)
      <p> Date :  {{$f->date_facture}} </p> 
      <p> Etat :  {{$f->etat_facture}} </p> 
    @endforeach
    @foreach($commandes as $cmd)
       <p>  N°Client : {{$cmd->id_client}} </p>
       @endforeach
   
  
       <div style=" margin-top:200px; position: absolute; right:0;top:150px;">
       <hr/>
          @foreach($clients as $cli)
             <p>Nom du client : {{$cli->nom}}
                <p>Adresse: {{$cli->address1}}</p>
               <p> 44003</p> 
               @endforeach
         </div>
</div>

        </div>
      
        </div> 
      </div>
    <h3>les information de votre commande</h3>
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
        <td>{{$l->quantite_cmd}}</td>
        <td>{{$l->prix_vente}}</td>
        <td>{{$l->prix_total}}</td>
        <td>{{$l->total_tva}}</td>
        <td>{{$l->total_ttc}}</td>
      </tr>
      @endforeach
    </table>
    <br/><br/>
    @foreach($commandes as $c)
   <p> Total Hors Taxe :   {{$c->prix_total}} DH</p> 
  <p>TVA à 20%	:       {{$c->prix_total*0.2}}   DH   </p> 
  <p>Remise	:       {{($c->remise*$c->prix_total)/100}}   DH   </p> 
  <p>TVA à 20%	:       {{$c->prix_total*0.2}}   DH   </p> 
<p>Total TTC en dirhams :    {{($c->prix_total+$c->prix_total*0.2)-(($c->remise*$c->prix_total)/100)}} DH</p> 
@endforeach
<br/><br/>
    </div>
   
</div>


        </body>
</html>   





   