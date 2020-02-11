<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Trang đăng nhập</title>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<!-- css -->
	<link rel="stylesheet"  href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}">


</head>
<body>
	<div class=" container justify-content-center align-items-center h-100">
		<div class="col col-sm-4"></div>
    <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
		<form action="{{route('user.login')}}" method="POST">
			@csrf		
				<div class="">
					<h2 class="text-center">Login now</h2>	
					@if($errors->count() > 0)
					<strong style="color: red">The following errors have occurred:</strong>
					@endif
					<div class="form-group  ">
						<label>Username</label>
						<input type="text" name="username" class="form-control " >

					</div>
					@if ($errors->has('username'))
					<span class="text-danger">{{ $errors->first('username') }}</span>
					@endif
					<div class="form-group ">
						<label>Password</label>
						<input type="text" name="password" class="form-control"  >
					</div>
					@if ($errors->has('password'))
					<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
					<br><br>
					<button type="submit" class="btn-primary">submit</button> 		
				</div>
		</form>
	</div>
</div>
</body>

</html>