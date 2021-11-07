<!DOCTYPE html>
<html>
<head>
    <title>Catégories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <style>
        #titre-edit{
            margin-top:50px;
            color:#0DB1B9;
        }
        #ack-btn{
            background-color:white;
            margin-top:50px;
        }
        #confirm-btn{
            background-color: #0DB1B9;
            color:white;
        }
        .back{
        color: #000;
        background-image: url('/images/back1 (2).jpg');
        background-repeat: no-repeat;
        width: 100%;
         height: 100%; background-size:1500px;
        }
        body{
            background-color: transparent !important;
            background-color:white;
            color: #000;
        background-image: url('/images/back1 (2).jpg');
        background-repeat: no-repeat;
        width: 100%;
         height: 100%; background-size:1500px;
        }
        #titre-h2{
            color:blue;
            font-size:25px;
        }
        input{
            background-color: transparent !important;
            border: 1px solid #00FF00;
            border-radius  : 60px;
        }
        textarea{
            background-color: transparent !important;
        }
    </style>
</head>
<body>
  
<div class="container">
    @yield('content')
</div>
   
</body>
</html>