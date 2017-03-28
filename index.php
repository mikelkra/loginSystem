<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login And Signin PHP OOP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheet/stylesheet.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body id="bodyID">
	<div class="row" id="start">
		<div class="col-xs-2 col-sm-3 col-md-4 col-lg-5">
		</div>
		<div class="col-xs-4 col-sm-3 col-md-2 col-lg-1">
				<a id="loginShow" href="#loginRow">Login </a>
		</div>
		<div class="col-xs-4 col-sm-3 col-md-2 col-lg-1">
			 	<a id="registerShow" href="#registerRow"> Register</a>
		</div>
		<div class="col-xs-2 col-sm-3 col-md-4 col-lg-5">
		</div>
	</div>
			

	<div class="row" id="loginRow" style="display:none">
		<div class="col-xs-1 col-sm-2 col-md-3 col-lg-4"></div>
		<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4">
			<legend>Login</legend>
			<div id="loginAjaxErrorMessage"></div>
					<form action="controller/private/Login.Class.php" method="POST" id="logForm">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="logE" id="logE" class="form-control input-lg" placeholder="E-mail"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="text" name="logP" id="logP" class="form-control input-lg" placeholder="Password"/>
					</div>
					<div class="input-group">
						<input type="hidden" name="logCount" id="logCount" /> 
					</div>
						<input type="submit" name="logBtn" id="logBtn" class="btn btn-primary" value="Login" />
					</form>
			</div>
		<div class="col-xs-1 col-sm-2 col-md-3 col-lg-4"></div>
	</div>
	<br/>


	<div class="row" id="registerRow" style="display:none">
		<div class="col-xs-1 col-sm-2 col-md-3 col-lg-4"></div>
		<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4">
				<legend>Register</legend>
				<div id="registerAjaxErrorMessage"></div>
					<form action="controller/private/Reg.Class.php" method="POST" id="regForm">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="regE" id="regE" class="form-control input-lg" placeholder="E-mail"/>
					</div>
					<div class="input-group"> 
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="text"name="regP" id="regP" class="form-control input-lg" placeholder="Password"/> 
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="text" name="regConfP" id="regConfP" class="form-control input-lg"placeholder="Confirm Password"/> 
					</div>
						<input type="submit" name="regBtn" id="regBtn" class="btn btn-primary" value="Register" />
					</form>
		</div>
		<div class="col-xs-1 col-sm-2 col-md-3 col-lg-4"></div>
	</div>
	
	
<script src="javascript/javascript.js"></script>
</body>
</html>