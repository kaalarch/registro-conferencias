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

   $error = 0;

   if(isset($_POST["nombre"], $_POST["usuario"], $_POST["password"], $_POST["con_password"], $_POST["email"])){
	   $nombre = $_POST["nombre"];
	   $usuario = $_POST["usuario"];
	   $password = $_POST["password"];
	   $con_password = $_POST["con_password"];
	   $email = $_POST["email"];

	   try{
		if(!isNull($nombre, $usuario, $password, $con_password, $email)){
			if(isEmail($email)){
				if(validaPassword($password, $con_password)){
					if (!usuarioExiste($con, $usuario)){
						if(!emailExiste($con, $email)){
							registraUsuario($con, $usuario, $password, $nombre, $email);
						}
						else{ $error = 5; }
					}
					else { $error = 4; }
				}
				else { $error = 3; }
			}
			else { $error = 2; }
		}
		else{ $error = 1; }
	   }

	   catch (Exception $e){
		   resulBlock([$e->getMessage()]);
		   //echo "<script>alert('Error: ".$e->getMessage()."');</script>";
	   }
   }
?>

<html>
	<head>
		<title>Registro</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	</head>
	
	<body>
		<div class="container">
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Reg&iacute;strate</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>  
					
					<div class="panel-body" >
						
						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>
							
							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>
							
							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="clave de reCaptcha"></div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>

							<div class="form-group">
							    <label for="email" class="col-md-3 control-label"></label>
								<div class="col-md-9">
									<label for="mensaje" style="width: 100%; color: red;" id="lblMensaje">
									<?php
									  if($error == 0){ echo " "; }
									  elseif($error == 1){ echo "FALTA UN CAMPO"; }
									  elseif($error == 2){ echo "EMAIL INVÁLIDO"; }
									  elseif($error == 3){ echo "LAS CONTRASEÑAS NO COINCIDEN"; }
									  elseif($error == 4){ echo "EL USUARIO INGRESADO YA SE ENCUENTRA REGISTRADO"; }
									  elseif($error == 5){ echo "EL EMAIL INGRESADO YA SE ENCUENTRA REGISTRADO"; }
									?>
								</label>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>													