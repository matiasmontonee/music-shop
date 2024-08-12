<?php
session_start();

require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/Cds.php';

// Verifica inicio de sesión
if ($_SESSION["rol_id"] != 1) {
    header("Location: ../../index.php");
    exit();
}
if (!isset($_SESSION["correo_electronico"])) {
    header("Location: ../../index.php");
    exit();
}

// cerrar sesión
if (isset($_POST["btnCerrarSesion"])) {

    session_unset();
    session_destroy();

    header("Location: ../../index.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="icon" href="../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<div class="content">
    <h1>Bienvenido al panel de administración</h1>

    <p>Hola, este es el panel de administración, aquí podrás editar, agregar o eliminar CDs a elección.</p>

    <div class="options-container">
        <a href="vistas/agregar-cd.php" class="option-button">Agregar CD</a>
        <a href="vistas/editar-cd.php" class="option-button">Editar CD</a>
        <a href="vistas/eliminar-cd.php" class="option-button">Eliminar CD</a>
        <a href="vistas/usuarios.php" class="option-button">Ver usuarios</a>
        <a href="vistas/compras.php" class="option-button"> Ver compras</a>

        <form method="post" action="">
            <input type="submit" name="btnCerrarSesion" value="Cerrar Sesión" class="option-button">
        </form>
    </div>
</div>