<?php
require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/Perfil.php';

if (!isset($_SESSION['correo_electronico'])) {
    header("Location: index.php"); 
    exit();
}

$perfil = new Perfil($conexion->obtenerConexion());

// Obtener datos del usuario actual
$correoElectronico = $_SESSION["correo_electronico"];
$datosUsuario = $perfil->obtenerDatosUsuario($correoElectronico);

// Obtener datos del rol del usuario
$rolId = $datosUsuario['rol_id'];
$rol = $perfil->obtenerNombreRol($rolId);

// Cerrar sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["btnCerrarSesion"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<h2 class="perfil-usuario">Tu Perfil</h2>

    <div class="centrado">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $datosUsuario['rol_id']; ?></td>
                    <td><?php echo $rol['nombre']; ?></td>
                    <td><?php echo $datosUsuario['nombre']; ?></td>
                    <td><?php echo $datosUsuario['correo_electronico']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="button-container-volver">
        <a href="index.php">Volver</a>
        <?php if ($usuarioHaIniciadoSesion): ?>
            <form method="post" action="">
                <input type="submit" name="btnCerrarSesion" value="Cerrar Sesión" class="button-container-volver">
            </form>
        <?php endif; ?>
    </div>