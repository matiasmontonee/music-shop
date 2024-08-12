<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Shop</title>
    <link rel="icon" href="favicon.ico" sizes="any">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<?php
$seccion = isset($_GET['seccion']) ? $_GET['seccion'] : 'home';

include('templates/views/header.php');

switch ($seccion) {
    case 'home':
        include('templates/views/home.php');
        break;
    case 'productos':
        include('templates/views/cds-list.php');
        break;
    case 'detalle':
        include('templates/views/cds-detail.php');
        break;
    case 'contacto':
        include('templates/views/contact-form.php');
        break;
    case 'login':
        include('templates/views/login.php');
        break;
    case 'register':
        include('templates/views/registro.php');
        break;
    case 'perfil':
        include('templates/views/perfil.php');
        break;
    case 'carrito':
        include('templates/views/carrito.php');
        break;
    default:
        include('templates/views/error-404.php');
        // redirigir a la home
        echo '<meta http-equiv="refresh" content="5;url=index.php?seccion=home">';
}

include('templates/views/footer.php');
?>

</body>
</html>