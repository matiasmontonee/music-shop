<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir las clases de PHPMailer y configurar la ruta de los archivos necesarios
require '../../PHPMailer/Exception.php';
require '../../PHPMailer/PHPMailer.php';
require '../../PHPMailer/SMTP.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
    $mensaje = isset($_POST["mensaje"]) ? trim($_POST["mensaje"]) : "";

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($correo) || empty($mensaje)) {
        echo '<div style="background-color: #ffe6e6; padding: 10px; border: 1px solid #ff6666; border-radius: 5px;">';
        echo '<p style="color: #FF0000; font-weight: bold;">Por favor, complete todos los campos del formulario.</p>';
        echo '<a href="../../index.php" style="text-decoration: none; color: #ffffff; background-color: #FF0000; padding: 8px 15px; border-radius: 5px; margin-top: 10px; display: inline-block;">Volver a la home</a>';
        echo '</div>';
        exit;
    }

    // Validar el formato del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo '<div style="background-color: #ffe6e6; padding: 10px; border: 1px solid #ff6666; border-radius: 5px;">';
        echo '<p style="color: #FF0000; font-weight: bold;">Por favor, ingrese una dirección de correo electrónico válida.</p>';
        echo '<a href="../../index.php" style="text-decoration: none; color: #ffffff; background-color: #FF0000; padding: 8px 15px; border-radius: 5px; margin-top: 10px; display: inline-block;">Volver a la home</a>';
        echo '</div>';
        exit;
    }

    // Destinatario del correo
    $destinatario = "guastavino.andres.daviinci@gmail.com";

    // Asunto del correo
    $asunto = "Mensaje de contacto de $nombre";

    // Mensaje del correo con marcadores de posición
    $mensajeCorreo = "Nombre: {nombre}\n";
    $mensajeCorreo .= "Correo: {correo}\n\n";
    $mensajeCorreo .= "Mensaje:\n{mensaje}";

    // Reemplazar marcadores de posición con datos reales
    $mensajeCorreo = str_replace('{nombre}', $nombre, $mensajeCorreo);
    $mensajeCorreo = str_replace('{correo}', $correo, $mensajeCorreo);
    $mensajeCorreo = str_replace('{mensaje}', $mensaje, $mensajeCorreo);

    // Configuración del servidor SMTP de Mailtrap
    $smtpServidor = "sandbox.smtp.mailtrap.io"; // Servidor SMTP de Mailtrap
    $smtpPuerto = 587; // Puerto SMTP

    $smtpUsuario = "87039a7b64d7a1";
    $smtpContraseña = "7ce74e9d4ba19e";

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->SMTPDebug = 0;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isSMTP();
        $mail->Host = $smtpServidor;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsuario;
        $mail->Password = $smtpContraseña;
        $mail->Port = $smtpPuerto;

        // Configurar destinatario, asunto y cuerpo del correo
        $mail->setFrom($correo, $nombre);
        $mail->addAddress($destinatario, '');
        $mail->Subject = $asunto;
        $mail->Body = $mensajeCorreo;

        // Enviar el correo
        $mail->send();

        // Mostrar mensaje de éxito
        echo '<div style="background-color: #e6ffe6; padding: 10px; border: 1px solid #66ff66; border-radius: 5px;">';
        echo '<p style="color: #008000; font-weight: bold;">Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.</p>';
        echo '<a href="../../index.php" style="text-decoration: none; color: #ffffff; background-color: #4CAF50; padding: 8px 15px; border-radius: 5px; margin-top: 10px; display: inline-block;">Volver a la home</a>';
        echo '</div>';
    } catch (Exception $e) {
        // Mostrar mensaje de error en caso de fallo
        echo '<div style="background-color: #ffe6e6; padding: 10px; border: 1px solid #ff6666; border-radius: 5px;">';
        echo '<p style="color: #FF0000; font-weight: bold;">Hubo un error al enviar el mensaje. Detalles del error: ' . $mail->ErrorInfo . '</p>';
        echo '<a href="../../index.php" style="text-decoration: none; color: #ffffff; background-color: #FF0000; padding: 8px 15px; border-radius: 5px; margin-top: 10px; display: inline-block;">Volver a la home</a>';
        echo '</div>';
    } 
} else {
    // Redirigir a la página principal si no es una solicitud POST
    header("Location: index.php?seccion=home");
    exit;
}
?>