@extends('layouts.master')
@section('content')
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="societe/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="societe/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="societe/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="societe/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="societe/css/main.css" rel="stylesheet" media="all">
   
</head>

<body>
    <div class="main-container">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Il y'a certain problems avec les données entrées<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <h2 class="title">Info sur votre Entreprise</h2>
                    <form action="{{ route('entreprise.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Nom" name="nom">
                        </div>

                        <div class="row row-space">
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="date" placeholder="Date de création" name="date_creation">
                                    
                                </div>
                            </div>
                          
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Raison sociale" name="raison_sociale">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Adresse" name="adresse">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Telephone" name="tele">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Site Web" name="site_web">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="ICE" name="ICE">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="RC" name="RC">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="IF" name="IF">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="CNSS" name="CNSS">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="file" placeholder="logo" name="logo">
                        </div>
                        <div >
                            <textarea  cols="50" rows="5" name="description"> une petite description sur votre entreprise </textarea>
                        </div>
                       
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" id="btn" >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection