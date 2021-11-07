<!DOCTYPE html>
<html>
<head>
  <title>devi</title>
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
                <h1 >Devi </h1> 
               </header>

             <p>Nom de société : {{$e->nom}}<br/>
               RABAT <br/>
               44220 <br> 
               0625148788 <p>
            @endforeach
            </div>
    
    <div style="background-color:#0DB1B9; width:200px; height:80px;">
   
    @foreach($commandes as $cmd)
      <p> Date :  {{$cmd->date_cmd_client}} </p> 
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
    
    <div style="margin-top:10px;">
    <table style="border:2px solid;">
      <tr style="background-color:#0DB1B9;">
        <th>Référence11</th>
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
   <p> Total Hors Taxe  :	    {{$c->prix_total}} DH</p> 

  <p>Remise	:       {{($c->remise*$c->prix_total)/100}}   DH   </p> 
  <p>TVA à 20%	:       {{$c->prix_total*0.2}}   DH   </p> 
<p>Total TTC en dirhams :    {{($c->prix_total+$c->prix_total*0.2)-(($c->remise*$c->prix_total)/100)}} DH</p> 
@endforeach
<br/><br/>
    </div>
    <p>Nous restons à votre disposition pour toute information complémentaire.
        Cordialement,
        </p>
        <p>Si ce devis vous convient, veuillez nous le retourner signé précédé de la mention :
              "BON POUR ACCORD ET EXECUTION DU DEVIS"
      </p>
      <p>Date : <strong>	{{$date}} </strong>	<span style="margin-left:460px;">Signature : </span></p>
     <br><br>
    
</div>
<footer>
      <p id="fin">Validité du devis : 3 mois </p>
        <p id="fin">Conditions de règlement : 40% à la commande, le solde à la livraison
          Toute somme non payée à sa date d'exigibilité produira de plein droit des intérêts de retard équivalents au triple du taux d'intérêts légal de l'année en cours ainsi que le paiement d'une somme de 40€ due au titre des frais de recouvrement
          </p>
          </footer>

        </body>
        
</html>   





   