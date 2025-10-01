<?php
include "conexion.php";

$sql = "SELECT u.id, u.nombre, u.apellido, u.nickname, u.email, r.nombre AS rol 
        FROM usuarios u
        INNER JOIN roles r ON u.rol_id = r.id";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listado de usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="p-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Listado de usuarios</h3>
            <a href="alta_usuario.php" class="btn btn-success mb-3">+ Nuevo usuario</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($fila = $resultado->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['apellido']; ?></td>
                        <td><?php echo $fila['nickname']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                        <td><?php echo $fila['rol']; ?></td>
                        <td>
                            <!-- Botón Editar -->
                            <a href="editar_usuario.php?id=<?php echo $fila['id']; ?>" class="btn btn-primary btn-sm">
                                ✏️
                            </a>
                            <!-- Botón Eliminar -->
                            <button onclick="confirmarEliminacion(<?php echo $fila['id']; ?>)" class="btn btn-danger btn-sm">
                                🗑️
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¡Atención!',
            text: "¿Está seguro que desea eliminar el usuario?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "eliminar_usuario.php?id=" + id;
            }
        });
    }
    </script>
</body>
</html>

