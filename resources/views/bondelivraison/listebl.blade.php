@extends('layouts.master')
@section('content')

<head>
<script>
$(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});

</script>
<style>
#mytable{
    margin-left:0px;
}
h4{
  color : blue;
  font-size:24px;
}

</style>
</head>
<body>


<div class="main-container">
<h4  style="color:#0DB1B9;" ><b>Liste de bonde de Livraison</b> </h4>
<br/>
	<div class="row">
	
    
        <div class="table-responsive">
              
              <table  id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                
                   <th>Numéro de bonde de livraison</th>
                    <th>quantité cammandée</th>
                     <th>quantité livrée</th>
                     <th>prix total</th>
                     <th>Action</th>
                     
                   </thead>
    <tbody>
    @foreach($bls as $bl) 
    <tr>
    
    <td>{{$bl->id}}</td>
    <td>{{$bl->qte_commandee}}</td>
    <td>{{$bl->qte_livree}}</td>
    <td>{{$bl->prix_total}}</td>
  
    <td>
    
    
   <a class="btn btn-info" href="{{route('bondelivraison.show',$bl->id)}}">Show</a>

   @can('bondeLivraison-bondepdf')
   <a class="btn btn-primary" href="{{route('bondelivraison.bondepdf',$bl->id)}}">Imprimer</a>
   @endcan
   
</td>
    </tr>
    @endforeach
 
    
    </tbody>
        
</table>

<div class="clearfix"></div>

                
            </div>
            
        </div>
	</div>
</div>



    
    
   
</body>
    @endsection