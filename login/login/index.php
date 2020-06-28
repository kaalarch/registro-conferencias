<?php
	require("Conexion.php");
	require("Usuario.php");
	require("funcs/funcs.php");
	session_start();

	if(isset($_SESSION["log"])){
		header("location:inicio.php");
	}

	$con = new Conexion();
	$con = $con->getCon();

	if($con instanceof PDO){
		if (isset($_POST["usuario"], $_POST["password"])){

			$user = $_POST["usuario"];
			$password = $_POST["password"];

			if (!isNullLogin($user, $password)){
				try{
					$logueo = login($con, $user, $password);

					if ($logueo instanceof Usuario){
						$_SESSION["log"] = $logueo;						
						header("location:inicio.php");
					}

					else{
						resultBlock(["Usuario y/o contraseña incorrecto"]);
					}
				}
				
				catch(Exception $e){
					resultBlock(["Error: ".$e->getMessage()]);
				}
			}
			
			else{
				resultBlock(["Falta un campo"]);
			}
		}
	}

	else{
		echo $con;
	}
?>

<html>
	<head>
		<title>Login</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		
	</head>
	
	<body>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Iniciar Sesi&oacute;n</div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="usuario o email" required>                                        
							</div>
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="password" type="password" class="form-control" name="password" placeholder="password" required>
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
					</div>                     
				</div>  
			</div>
		</div>
	</body>
</html>				