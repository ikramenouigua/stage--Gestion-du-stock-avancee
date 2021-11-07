<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>

	<body>

		<div class="container-login100" style="background-image: url('images/login.jpg');">
			<div class="inner" style="background-color:white;">
				<form action="{{ route('register.custom') }}" method="POST">
                @csrf
					<h3>Inscription</h3>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">Prénom</label>
							<input type="text" class="form-control" name="name"
                                    required autofocus>
						</div>
						<div class="form-wrapper">
							<label for="">Nom</label>
							<input type="text" class="form-control" name="email" required autofocus>
						</div>
					</div>
					<div class="form-wrapper">
						<label for="">Email</label>
						<input type="text" class="form-control" name="email" required autofocus>
					</div>
					<div class="form-wrapper">
						<label for="">Password</label>
						<input type="password" class="form-control"  name="password" required> 
					</div>
					<div class="form-wrapper">
						<label for="">Confirm Password</label>
						<input type="password" class="form-control"  name="password" required>
                        @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
					</div>
                    <div class="form-wrapper">
                   <label> Type  </label>
                   <select type="text" name ="type"  class="form-control" required>
					   @foreach($roles as $role)
				   <option value="{{$role->name}}">{{$role->name}}</option>
				    @endforeach
                     </select>
				  
                                  @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember Me
							<span class="checkmark"></span>
						</label>
					</div>
                                <button type="submit" class="login100-form-btn">Inscrioption</button>
                            
				</form>
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
