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
            <th>Reference </th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Telephone 1</th>
                <th>Telephone 2</th>
                <th>Email</th>
                <th>Addresse 1</th>
                <th>Addresse 2</th>
            </tr>
        </thead>
        

        <tbody>
        <!-- to make storage file static php artisan storage:link -->
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id}}</td>
				<td>{{ $client->nom }}</td>
                <td>{{ $client->prenom }}</td>
                <td>{{ $client->tel1 }}</td>
                <td>{{ $client->tel2 }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->address1 }}</td>
                <td>{{ $client->address2 }}</td>
                
               
            </tr>
            
            @endforeach

        </tbody>

    </table>
@endsection```