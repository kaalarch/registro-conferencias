<?php
class Usuario{
	private $idUsuario;
	private $nombre;
	private $correo;
	private $contrasenia;
	
	function __construct($idUsuario, $nombre, $correo, $contrasenia){ 
		$this->idUsuario=$idUsuario;
		$this->nombre=$nombre;
		$this->correo=$correo;
		$this->contrasenia=$contrasenia;
	}

	function getId(){return $this->idUsuario;}
	function getNombre(){return $this->nombre;}
	function getCorreo(){return $this->correo;}
	function getContrasenia(){return $this->contrasenia;}

	function setId($idUsuario){$this->idUsuario=$idUsuario;}
	function setNombre($nombre){$this->nombre=$nombre;}
	function setCorreo($correo){$this->correo=$correo;}
	function setContrasenia($contrasenia){$this->contrasenia=$contrasenia;}
}
?>