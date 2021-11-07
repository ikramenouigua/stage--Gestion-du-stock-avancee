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
</style>
<br><br>
<table class="tableau-style">

        <thead>
            <tr>
                <th>Reference</th>
                <th>Client</th>
                <th>Date du commande</th>
                <th>total des produits</th>
                <th>Montant( DH)</th>
                <th>etat du commande</th>
                
            </tr>
        </thead>
        

        <tbody>
        <!-- to make storage file static php artisan storage:link -->
        @foreach ($co_clients as $co_client)
            <tr>
                <td>{{ $co_client->reference_commande }}</td>
				<td>{{ \App\Models\Client::find($co_client->id_client)->nom }} {{ \App\Models\Client::find($co_client->id_client)->prenom }}</td>
                <td>{{ $co_client->date_cmd_client }}</td>
                <td>{{ $co_client->total_produits }}</td>
                <td>{{ $co_client->prix_total }}</td>
                <td><p style="background-color:#0DB1B9; text-weight:bolder;font-size:16px;text-align:center;border-radius:20px;">{{ $co_client->etat_commande }}</p></td>
                
               
               
            </tr>
            
            @endforeach

        </tbody>

    </table>
@endsection