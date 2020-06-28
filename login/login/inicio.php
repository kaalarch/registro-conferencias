<?php
    require("Conexion.php");
	require("Usuario.php");
	require("funcs/funcs.php");

	session_start();

	if(!isset($_SESSION["log"])){
		header("location:index.php");
	}

	$con = new Conexion();
	$con = $con->getCon();

	if(isset($_GET["opcion"])){
		if($_GET["opcion"] != "close"){
			if($con instanceof PDO){
				$opcion = $_GET["opcion"];
				try{
					if(registrarEvento($con, $_SESSION["log"]->getId(), $opcion)){
						unset($_GET["opcion"]);
						echo "<script>alert('Se registró con éxito el evento')</script>";
					}
					
					else{
						resultBlock(["Hubo un error al registrar el evento"]);
					}
				}
		
				catch(Exception $e){
					echo $e->getMessage();
				}
			}
		
			else{ echo $con; }
		}
		
		else{
			session_destroy();
			header("location:index.php");
		}
	}

	if($con instanceof PDO){
		try{
			$result = getMisEventos($con, $_SESSION["log"]->getId());
			if($result!=null){ 
				//echo var_dump($result);
				$jsonMisEventos = json_encode($result);
			} 
		}

		catch(Exception $e){
			echo $e->getMessage();
		}
	}

	else{ echo $con; }

	if($con instanceof PDO){
		try{
			$result = getEventos($con);
			if($result!=null){ 
				//echo var_dump($result);
				$json = json_encode($result);
			} 
		}

		catch(Exception $e){
			echo $e->getMessage();
		}
	}

	else{ echo $con; }
?>

<html>
	<head>
		<title>Inicio</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<link rel="stylesheet" href="css/inicio.css" >
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="js/bootstrap.min.js" ></script>
		<script>
			var json = <?php echo $json;?>
		</script>
		<script>
			var jsonMisEventos = <?php echo $jsonMisEventos;?>
		</script>
		<script src="js/inicio.js" ></script>
	</head>
	
	<body>
	<div style="float:right; font-size: 85%; position: relative; top:10px; right: 10px;">
	    <a id="signout" onclick="cerrarSesion()">Cerrar Sesión</a>
    </div>	
<!--Mis Eventos-->
		<div class="container" style="width: 100%;">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Mis Eventos</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="inicio.php">Recargar página</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						<div id="loginform" class="form-horizontal">
							<ul id="list-miseventos"></ul> 
                        </div>
					</div> 

				</div>  
			</div>
		</div>
		<div class="container" style="width: 100%;">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Eventos disponibles</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="inicio.php">Recargar página</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body">
						<div id="loginform" class="form-horizontal">
							 <ul id="list-disponibles"></ul> 
							 <form method="GET" id="opcion-form" style="display: none;">
								 <input type="text" name="opcion" id="txtOpcion">
							 </form>
                        </div>
					</div>                     
				</div>  
			</div>
		</div>
	</body>
</html>							