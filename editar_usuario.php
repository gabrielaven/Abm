<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
    $usuario = $resultado->fetch_assoc();
}

// Actualizar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $rol_id = $_POST['rol_id'];

    $sql = "UPDATE usuarios 
            SET nombre='$nombre', apellido='$apellido', nickname='$nickname', email='$email', rol_id=$rol_id 
            WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: listado_usuarios.php");
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Traer roles
$roles = $conexion->query("SELECT * FROM roles");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Editar Usuario</h3>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="<?php echo $usuario['apellido']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nickname</label>
                    <input type="text" name="nickname" value="<?php echo $usuario['nickname']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Rol</label>
                    <select name="rol_id" class="form-control" required>
                        <?php while($rol = $roles->fetch_assoc()){ ?>
                            <option value="<?php echo $rol['id']; ?>" 
                                <?php if ($rol['id'] == $usuario['rol_id']) echo "selected"; ?>>
                                <?php echo $rol['nombre']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="listado_usuarios.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
