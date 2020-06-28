<?php
	function isNull($nombre, $user, $pass, $pass_con, $email){
		if(strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	
	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}
	
	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}
	
	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function usuarioExiste($con, $usuario)
	{
	  require_once 'Usuario.php';
	  $query = "select id_usuario from Usuario where id_usuario = '".$usuario."'";
      $result=$con->query($query);
      $result->setFetchMode(PDO::FETCH_NUM);
      $result = $result->fetchAll();

      if($result!=null){ 
		return true; } 
		
      else{ return false; }
	}
	
	function emailExiste($con, $email)
	{
	  require_once 'Usuario.php';
	  $query = "select correo from Usuario where correo = '".$email."'";
      $result=$con->query($query);
      $result->setFetchMode(PDO::FETCH_NUM);
      $result = $result->fetchAll();

      if($result!=null){ 
		return true; } 
		
      else{ return false; }
	}
	
	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($password) 
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	
	function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function registraUsuario($con, $usuario, $pass, $nombre, $email){
      $query = "Insert into Usuario values ('".$usuario."', '".$nombre."', '".$email."', '".$pass."')";
      if($con->exec($query)>0){
        $nuevo = new Usuario($usuario, $nombre, $email, $pass);
        $_SESSION["log"] = $nuevo;
        header("location:inicio.php");
      }
      else{
        echo "<script>alert('Error')</script>";
      }
	}
	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tipo de seguridad';
		$mail->Host = 'smtp.hosting.com';
		$mail->Port = 'puerto';
		
		$mail->Username = 'miemail@dominio.com';
		$mail->Password = 'password';
		
		$mail->setFrom('miemail@dominio.com', 'Sistema de Usuarios');
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		return true;
		else
		return false;
	}
	
	function validaIdToken($id, $token){
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function isNullLogin($usuario, $password){
		if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function login($con, $usuario, $password)
	{
	  require_once 'Usuario.php';
	  $query = "select * from Usuario where id_usuario = '".$usuario."' and contrasenia = '".$password."'";
      $result=$con->query($query);
      $result->setFetchMode(PDO::FETCH_NUM);
      $result = $result->fetchAll();

      if($result!=null){
        $result = $result[0];  
        $usuario = new Usuario($result[0], $result[1], $result[2], $result[3]);
		return $usuario;
		}
		
        else{
			return false;
        }
	}
	
	function lastSession($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}
	
	function isActivo($usuario)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param('ss', $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		global $mysqli;
		
		$token = generateToken();
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
	
	function getPasswordRequest($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($user_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	function cambiaPassword($password, $user_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?");
		$stmt->bind_param('sis', $password, $user_id, $token);
		
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}		

	function getEventos($con){
		$query = "select * from Evento";
		$result=$con->query($query);
		$result->setFetchMode(PDO::FETCH_NUM);
		$result = $result->fetchAll();
		return $result;
	}

	function getMisEventos($con, $id_usuario){
		$query = "select Evento.id_evento, Evento.nombre, Evento.fecha, Evento.lugar from Historial
		inner join Usuario
		inner join Evento
		on Historial.id_usuario = Usuario.id_usuario
		and Historial.id_evento = Evento.id_evento
		where Usuario.id_usuario = '".$id_usuario."'";
		$result=$con->query($query);
		$result->setFetchMode(PDO::FETCH_NUM);
		$result = $result->fetchAll();
		return $result;
	}

	function registrarEvento($con, $id_usuario, $id_evento){
		$select = "Select capacidad, ocupados from Evento where id_evento = ".$id_evento;
		$insert = "Insert into Historial values ('".$id_usuario."', '".$id_evento."')";
		$update = "Update Evento set ocupados = ocupados + 1 where id_evento = ".$id_evento;

		$result=$con->query($select);
		$result->setFetchMode(PDO::FETCH_NUM);
		$result = $result->fetchAll();

		if($result[0][0] > $result[0][1]){
			if(!existeRegistro($con, $id_usuario, $id_evento)){
				if($con->exec($update)>0 && $con->exec($insert)>0){
					return true;
				}
	
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	function existeRegistro($con, $id_usuario, $id_evento){
		$query = "select * from Historial where id_usuario = '".$id_usuario."' and id_evento = ".$id_evento;
		$result=$con->query($query);
		$result->setFetchMode(PDO::FETCH_NUM);
		$result = $result->fetchAll();

		if($result != null){ return true; }
		else{ return false; }
	}
