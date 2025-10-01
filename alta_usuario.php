<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $rol_id = $_POST['rol_id'];

    $sql = "INSERT INTO usuarios (nombre, apellido, nickname, email, rol_id) 
            VALUES ('$nombre', '$apellido', '$nickname', '$email', $rol_id)";
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
    <title>Alta de usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Nuevo Usuario</h3>
            <form method="post">
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nickname</label>
                    <input type="text" name="nickname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Rol</label>
                    <select name="rol_id" class="form-control" required>
                        <option value="">-- Selecciona un rol --</option>
                        <?php while($rol = $roles->fetch_assoc()){ ?>
                            <option value="<?php echo $rol['id']; ?>"><?php echo $rol['nombre']; ?></option>
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
