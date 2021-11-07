@extends('layouts.master')
@section('content')
<style>
.tableau-style  {
    border-collapse: collapse;
    min-width: 400px;
    width: auto;
    box-shadow: 0 5px 50px rgba(0,0,0,0.15);
    cursor: pointer;
    margin: 50px auto;
    margin-left:300px;
    border: 1px solid midnightblue;
    /* border: 1px solid #ddd;  */
}
.add_product{
    width:15%;
    height:7%;
}
thead tr {
    background-color: #142127;
    color: #fff;
    text-align: left;
    font-size:15px;
    font-weight: normal;
}
th, td {
    padding: 12px 15px;
}
tbody tr, td, th {
    border: 1px solid #ddd;
}
tbody tr:nth-child(even){
    background-color: #f3f3f3;
}
.title{
    margin-left:20%;
    font-style:italic;
}
</style>
<br><br><br>
<h2 class="title"> Facture fournisseurs</h2>
<table class="tableau-style">

        <thead>
            <tr>
            <th>Id facture</th>
                <th>Reference commande</th>
                <th>Date du facture</th>
                <th>Fournisseur</th>
                <th>etat du facture</th>
            </tr>
        </thead>
        

        <tbody>
        <!-- to make storage file static php artisan storage:link -->
        @foreach ($factures as $facture)
            <tr>
                <td>{{ $facture->id }}</td>
                <td>{{ $facture->id_commande_fourni }}</td>
                <td>{{ $facture->date_facture }}</td>
                
				<td>{{ \App\Models\Fournisseur::find($facture->id_fournisseur)->nom_fournisseur }}</td>
                
                <td><p style="background-color:#0DB1B9; text-weight:bolder;font-size:16px;text-align:center;border-radius:20px;margin-top:5px;">{{ $facture->etat_facture }}</p></td>
                
               
               
            </tr>
            
            @endforeach

        </tbody>

    </table>
    <br>
<h2 class="title"> Facture clients</h2>
<table class="tableau-style">
        <thead>
            <tr>
            <th>Id facture</th>
                <th>Reference commande</th>
                <th>Date du facture</th>
                <th>Client</th>
                <th>etat du facture</th>
            </tr>
        </thead>
        

        <tbody>
        <!-- to make storage file static php artisan storage:link -->
        @foreach ($cli_factures as $cli_facture)
            <tr>
                <td>{{ $cli_facture->id }}</td>
                <td>{{ $cli_facture->id_commande_client }}</td>
                <td>{{ $cli_facture->date_facture }}</td>
                
				<td>{{ \App\Models\Client::find($cli_facture->id_client)->nom }}</td>
                
                <td><p style="background-color:#0DB1B9; text-weight:bolder;font-size:16px;text-align:center;border-radius:20px;margin-top:5px;">{{ $cli_facture->etat_facture }}</p></td>
                
               
               
            </tr>
            
            @endforeach

        </tbody>

    </table>
@endsection