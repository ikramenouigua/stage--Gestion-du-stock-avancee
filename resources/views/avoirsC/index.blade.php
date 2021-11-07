@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html>
  <head>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin-top: 1px;
      font-size: 32px;
      color: black;
      z-index: 2;
      }
      h2 {
      font-weight: 400;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 20px 0 #095484; 
      }
      .banner {
      position: relative;
      height: 210px;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      margin-top:20px;
      }
      select {
        margin-top:20px;
      width: 70%;
      padding: 7px 0;
      background: transparent;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder, a {
      color: #095484;
      }
      .item input:hover, .item select:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #095484;
      color: #095484;
      }
      .item {
      position: relative;
      margin: 50px 0;
      }
     
     
      .item i {
      right: 2%;
      top: 30px;
      z-index: 1;
      }
     
      label{
        
        width:20px;
      }
      #liste{
        border : black 2px solid;
      }
     #input-invisible{
         background-color:white;
         color:white;
         border:none;
     }
     
     
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      #bu {
      width : 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background-color: #0DB1B9;
      font-size: 16px;
      color: white;
      cursor: pointer;
      }
      button:hover {
      background: #0666a3;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      #table{
         background-color:black;
      }
      #qte{
        margin-top:100px;
      }
      #button {
       transition-duration: 0.4s;
       width:100px;
       background-color: #0DB1B9;
       color:white;
       }
       #td{
         border-color:white;
       }
       #btn{
         width:80px;
         background-color: #0DB1B9;
         color:white;
         border-radius:12px;
       }
       #cmd{
         width:750px;
       }
        #input-client{
          width : 700px;
        }
       #button:hover {
       background-color: blue; /* Green */
     
    
             }
      }
    </style>
  </head>
  <body>
   <br><br><br>
<div class="main-container">
<table class="cont_div">
      <tr>
      <th>         </th>
        <th>Numéro du avoire</th>
        <th>Réference du commande </th>
        <th>Date avoire</th>
        
      
        

      </tr>
      @foreach($avoires as $avoire)
      <tr>
      <td>
		<label class="checkbox-wrap checkbox-primary">
		 <input type="checkbox" name="ref[]" value="{{$avoire->id}}">
		 <span class="checkmark"></span>
		</label>
        <td>{{$avoire->id}}</td>
        <td>{{$avoire->nom_client}}</td>
        <td>{{$avoire->date_avoire}}</td>
          <td> <a class="btn btn-primary" href="{{route('avoirePDF',$avoire->numero_commande)}}"><i class="fas fa-file-pdf"></i></a>
            </td>
      </tr>
      @endforeach
  </table>
    </div>
  </body>

</html>
@endsection