@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html>
  <head>
    <title>Paramètres</title>
   
    
    <style>
      html, body {
      min-height: 100%;
      padding: 0;
      margin: 0;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #0DB1B9;
      }
      h1 {
      margin: 0 0 20px;
      font-weight: 400;
      color: black;
      }
      p {
      margin: 0 0 5px;
      }
      .main-block {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #0DB1B9;
      }
      form {
      padding: 25px;
      margin: 25px;
      box-shadow: 0 2px 5px #0DB1B9; 
      background: #f5f5f5; 
      }
      .fas {
      margin: 25px 10px 0;
      font-size: 72px;
      color: #fff;
      }
      .fa-envelope {
      transform: rotate(-20deg);
      }
      .fa-at , .fa-mail-bulk{
      transform: rotate(10deg);
      }
      input, textarea {
      width: calc(100% - 18px);
      padding: 8px;
      margin-bottom: 20px;
      border: 1px solid #1c87c9;
      outline: none;
      }
      input::placeholder {
      color: #666;
      }
      button {
      width: 100%;
      padding: 10px;
      border: none;
      background: black; 
      font-size: 16px;
      font-weight: 400;
      color: white;
      }
      button:hover {
      background: #0DB1B9;
      }    
      @media (min-width: 568px) {
      .main-block {
      flex-direction: row;
      }
      .left-part, form {
      width: 50%;
      }
      .fa-envelope {
      margin-top: 0;
      margin-left: 20%;
      }
      .fa-at {
      margin-top: -10%;
      margin-left: 65%;
      }
      .fa-mail-bulk {
      margin-top: 2%;
      margin-left: 28%;
      }
      }
    </style>
  </head>
  <body class="main-container">
    <div class="main-block">
      <div class="left-part">
        <i class="fas fa-envelope"></i>
        <i class="fas fa-at"></i>
        <i class="fas fa-mail-bulk"></i>
      </div>
      <form  action="{{ route('setting.store') }}"  method="POST">
        @csrf
        <h1>Paramètres</h1>
        
        <p>Préfix</p>
        <div>
          <input type="text" name="prefix">
        </div>
        <p>Order</p>
        <div>
        <input type="text" name="order">
        </div>
        <p>Order 2</p>
        <div>
        <input type="text" name="order2">
        </div>
        <button type="submit" href="/">Valider</button>
      </form>
    </div>
  </body>
</html>
@endsection