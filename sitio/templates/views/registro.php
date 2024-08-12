<?php

require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/Registro.php';

// Variables para mensajes
$mensajeError = "";

// Lógica de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioManager = new Registro($db);

    // Recopilar datos del formulario
    $nombre = $_POST["nombre"];
    $correo_registro = $_POST["correo_registro"];
    $contrasena_registro = $_POST["contrasena_registro"];
    $confirmar_contrasena = $_POST["confirmar_contrasena"];

    // Intentar registrar usuario
    $resultadoRegistro = $usuarioManager->registrarUsuario($correo_registro, $contrasena_registro, $confirmar_contrasena, $nombre);

    if ($resultadoRegistro === true) {
        // Redirigir a la home después de un registro exitoso
        header("Location: index.php");
        exit();
    } else {
        $mensajeError = $resultadoRegistro;
    }
}
?>

<div class="login-container">
    <h2>Registro</h2>
    <?php
    if (!empty($mensajeError)) {
        echo '<div style="color:red;">' . $mensajeError . '</div>';
    }
    ?>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
    
        <label for="correo_registro">Correo electrónico:</label>
        <input type="text" id="correo_registro" name="correo_registro" value="<?php echo isset($_POST['correo_registro']) ? $_POST['correo_registro'] : ''; ?>">
    
        <label for="contrasena_registro">Contraseña:</label>
        <input type="password" id="contrasena_registro" name="contrasena_registro">
    
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena">
    
        <input type="submit" name="btnRegistrarse" value="Registrarse" class="btn"> 
    </form>
</div>