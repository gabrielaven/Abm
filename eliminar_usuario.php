<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: listado_usuarios.php");
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
}
?>
