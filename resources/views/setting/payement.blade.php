@extends('layouts.master')
 @section('content')
 <head>
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" type="text/css" href="css/util.css">
	 <link rel="stylesheet" type="text/css" href="css/main.css">
 </head>
<body style="background-color : white;">
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2  style="color:#0DB1B9;"> Mode de payement</h2>
        </div>
    </div>
</div>

<div class="main-container">
<!--<div style="margin-top:2%;">
<p>Rechercher</p><input type="text" name="search"></div> -->

 <!-- Search Widget -->
 
         <form >
            {{ csrf_field() }}
            <div>
                <div class="form-group">
						<div class="form-wrapper">
                        <select class="form-control">
                        <option>No.....</option>
                        </select>
						</div>
						<div class="form-wrapper">
                      
						</div>
					</div>
        </form> 
        <div class="form-group">
						<div class="form-wrapper">
                          
							<label for="">Nom figurant sur carte</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-wrapper">
							<label for="">Numéro de carte</label>
							<input type="text" class="form-control" name="email" >
                            
						</div>
					</div>

						<div class="form-wrapper">
							<label for="">MM/AA</label>
							<input type="text" class="form-control" name="email" >
						</div>
					</div>
    
     <br/><br/>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn-client">Enregistrer</button>
                </div>
        <br/><br/<br/>
     
        </body>
 @endsection