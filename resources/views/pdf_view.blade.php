<!DOCTYPE html>
<html>
<head>
  <title>Bon de commande</title>
  <style>
h1{
background-color:#0DB1B9;
margin-left:50px;
margin-top:20px;

  
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
              @foreach($entreprises as $e)
              <img src="{{public_path('images/').$e->logo}}" id="logo">
              @endforeach
               </header>
               @foreach($commandes as $cmd)
               <h1 >Bon de commande N° {{$cmd->reference_commande}}</h1> 
              @endforeach
    
         </div>
</div>

        </div>
      
        </div> 
      </div>
    </div><br>
    <div style="margin-top:50px;">
    <table style="border:2px solid;">
      <tr style="background-color:#0DB1B9;">
        <th>Référence</th>
        <th>Libéllé du produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
      
      </tr>

    @foreach($data as $l)
      <tr>
        <td>{{$l->id_produit}}</td>
        <td>{{$l->libelle_produit}}</td>
        <td>{{$l->quantite_cmd}}</td>
        <td>{{$l->prix_vente}}</td>
        <td>{{$l->prix_total}}</td>

      </tr>
      @endforeach
    </table>
    <br/><br/>
    @foreach($commandes as $c)
   <p> Total          : {{$c->prix_total}}</p> 
   <p> Fournisseur    : {{$c->nom_fournisseur}}</p> 
 
@endforeach
<br/><br/>
    </div>
  
      
      <p style="margin-right:2px;">Le : {{$date}}		</p>
</div>


        </body>
</html>   
