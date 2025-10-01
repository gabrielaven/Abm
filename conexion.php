<?php
$host = "localhost";
$usuario = "root";
$clave = "";  // en WAMP por defecto no tiene clave
$bd = "gestion_usuarios";

$conexion = new mysqli($host, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
