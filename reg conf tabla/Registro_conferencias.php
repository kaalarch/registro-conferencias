<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <!-- Font Awesome Icons -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

<!-- Plugin CSS -->
<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

<!-- Theme CSS - Includes Bootstrap -->
<link href="css/creative.min.css" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet">
</head>
    <title>
        Registro Conferencias
    </title>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Modelos de prueba de software</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="">Registrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="">Modificar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="">Eliminar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-left">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Registrar conferencia.</h1>
          <hr class="divider light my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <form action="Registro.php" method="post">
        <p>Nombre de la conferencia: <input type="text" name="nombre" required size="25" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"/></p>
        <p>SEDE: <input type="text" name="sede" required size="25" /></p>
<?php 
date_default_timezone_set('America/Los_Angeles');
$fcha = date("Y-m-d");
echo"<p>Fecha de la conferencia: <input type= date name= fcha value=  $fcha  min=  $fcha  max= 2090-12-31T12:00Z/></p>"
 ?>
        <p>Hora de inicio: <input type="time" name="inicio" value="00:00:00" max="22:00:00" min="07:00:00" step="1"  /></p>
        <p>Hora de termino: <input type="time" name="termino" value="00:00:00" max="23:00:00" min="08:00:00" step="1"  /></p>
        <p>Nombre(s) del conferencista: <input type="text" name="nomco" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" size="25" /></p>
        <p>Apellido paterno: <input type="text" name="ap" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"size="25"/></p> 
        <p>Apellido materno: <input type="text" name="am" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"size="25"/></p>
        <p>Numero de lugares: <input type="number" name="nlugares" required min="0" max="999999"pattern="[0-9]+" /></p>
        <div>
        <input type="submit" class="btn btn-primary btn-xl js-scroll-trigger" data-toggle="modal" data-target="#myModal"/>
        </div>  
       </form>
       <br><br>

  <!-- Footer -->
  <footer class="bg-light py-5">
   
      <div class="small text-center text-muted">Escalona Espinosa omam Sebastian & Hernadéz de la Rosa Itzel Montserrat / Modelos de Prueba de Software / 3CV61</div>

  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

</body>

</html>