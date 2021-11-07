@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="client/style.css" />



</head>

<body style="background-color:white;">
	<div id="booking" class="section">
		<div class="main-container">
			
				<div class="row">
					<div class="booking-form">
						<div class="form-header">
							<h1 style="color:#0DB1B9;">Client</h1>
						</div>
						<form action="{{route('clients.store')}}" method="POST">
							@csrf
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label">Nom</span>
										<input class="form-control" type="text" placeholder="nom" name="nom">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label">Prénom</span>
										<input class="form-control" type="text" placeholder="prénom" name="prenom">
									</div>
								</div>
							</div>
							<div class="form-group">
								<span class="form-label">Email</span>
								<input class="form-control" type="tel" placeholder="email" name="email">
							</div>
							<div class="form-group">
								<span class="form-label">Téléphone 1</span>
								<input class="form-control" type="tel" placeholder="phone 1" name="tel1">
							</div>
							<div class="form-group">
								<span class="form-label">Téléphone 2</span>
								<input class="form-control" type="tel" placeholder="phone 2" name="tel2">
							</div>
							<div class="form-group">
								<span class="form-label">Addresse 1</span>
								<input class="form-control" type="text" placeholder="adresse 1" name="address1">
							</div>
							
							<div class="form-group">
								<span class="form-label">Addresse 2</span>
								<input class="form-control" type="text" placeholder="adresse 2" name="addresse2">
                               
	             
							</div>
							<div class="form-group">
							<span class="form-label">Groupe</span>
                   <select type="text" name ="group"  class="form-control" required>
					   @foreach($groups as $group)
				   <option class="form-control" value="{{$group->id}}">{{$group->nom}}</option>
				    @endforeach
                     </select>
				  
                       <br><br>         
					</div>
							<div class="col-sm-10">
							  <div class="form-btn">
								<button type="submit" class="submit-btn" id="btn" >Valider</button>
	                           </div>
							   </div>
	
							   </form>
	
							
					</div>	
			</div>
			</div>
			</div>

			
   </body>

</html>
@endsection