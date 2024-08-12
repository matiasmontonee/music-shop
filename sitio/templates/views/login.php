<?php
require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/Login.php';

// Variables para mensajes
$mensajeError = "";

// Lógica de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioManager = new Login($db);

    // Recopilar datos del formulario
    $correo_login = $_POST["correo_login"];
    $contrasena_login = $_POST["contrasena_login"];

    // Intentar iniciar sesión
    $resultadoLogin = $usuarioManager->iniciarSesion($correo_login, $contrasena_login);

    if ($resultadoLogin !== true) {
        $mensajeError = $resultadoLogin;
    }
}
?>

<div class="login-container">
    <h2>Iniciar sesión</h2>
    <?php
    if (!empty($mensajeError)) {
        echo '<div style="color:red;">' . $mensajeError . '</div>';
    }
    ?>
    <form method="post" action="">
        <label for="correo_login">Correo electrónico:</label>
        <input type="text" id="correo_login" name="correo_login" value="<?php echo isset($_POST['correo_login']) ? $_POST['correo_login'] : ''; ?>">

        <label for="contrasena_login">Contraseña:</label>
        <input type="password" id="contrasena_login" name="contrasena_login">
        
        <p style="font-size: 15px;">¿No tienes una cuenta? <a href="index.php?seccion=register">Registrarse</a></p>

        <input type="submit" name="btnIngresar" value="Iniciar sesión" class="btn"> 
    </form>
</div>