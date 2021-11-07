@extends('clients.layout')
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="client/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="client/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body class="body-edit">
	<div id="booking" class="section">
		<div class="main-container">
			
				<div class="row">
					<div class="booking-form">
						<div class="form-header">
                           
							<h1 style="color:#0DB1B9;margin-left:100px;">Modifier ce Client</h1>
						</div>
                       
						
    <form action="{{ route('clients.update',$client->id) }}" method="POST">
        @csrf
        @method('PUT')
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label">Nom</span>
										<input class="form-control" type="text" name="nom" value="{{$client->nom}}">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label">Prénom</span>
										<input class="form-control" type="text" value="{{$client->prenom}}" name="prenom">
									</div>
								</div>
							</div>
							<div class="form-group">
								<span class="form-label">Email</span>
								<input class="form-control" type="tel" value="{{$client->email}}" name="email">
							</div>
							<div class="form-group">
								<span class="form-label">Téléphone 1</span>
								<input class="form-control" type="tel" value="{{$client->tel1}}" name="tel1">
							</div>
							<div class="form-group">
								<span class="form-label">Téléphone 2</span>
								<input class="form-control" type="tel" value="{{$client->tel2}}" name="tel2">
							</div>
							<div class="form-group">
								<span class="form-label">Addresse 1</span>
								<input class="form-control" type="text" value="{{$client->address1}}" name="address1">
							</div>
							<div class="form-group">
								<span class="form-label">Addresse 2</span>
								<input class="form-control" type="text" value="{{$client->addresse2}}" name="addresse2">
                              
	                                                       
							</div>
							<div class="form-group">
							<span class="form-label">Groupe</span>
                   <select type="text" name ="group" value={{ \App\Models\groupClient::find($client->id_group_client)->nom }} class="form-control" required>
					   @foreach($groups as $group)
				   <option class="form-control" value="{{$group->id}}">{{$group->nom}}</option>
				    @endforeach
                     </select>
				  
                               
					
					<button type="submit" class="submit-btn" id="btn">Modifier</button>
					</div>
							<div class="col-sm-8">
							<div class="form-btn">
								
	</div>
	
							
	</div>
	</div>
							
						</form>
                        
					
</html>
