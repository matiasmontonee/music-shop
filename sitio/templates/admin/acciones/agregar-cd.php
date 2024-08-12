<?php
session_start();

require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Cds.php';

function validarDatos($datos_cd)
{
    if (
        empty($datos_cd['titulo']) ||
        empty($datos_cd['sinopsis']) ||
        empty($datos_cd['precio']) ||
        empty($datos_cd['imagen']) ||
        empty($datos_cd['texto']) ||
        empty($datos_cd['discografica_id']) ||
        empty($datos_cd['productor_id']) ||
        empty($datos_cd['genero_id'])
    ) {
        $_SESSION['mensajeError'] = "Todos los campos son obligatorios. Por favor, completa todos los campos.";
        return false;
    }

    return true;
}

function guardarImagen($imagen)
{
    $directorioImagenes = __DIR__ . '/../../../assets/imgs/';
    $nombreImagen = uniqid('imagen_') . '_' . time() . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
    $rutaCompleta = $directorioImagenes . $nombreImagen;
    move_uploaded_file($imagen['tmp_name'], $rutaCompleta);
    return $nombreImagen;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos_cd = [
        'titulo' => $_POST['titulo'],
        'sinopsis' => $_POST['sinopsis'],
        'precio' => $_POST['precio'],
        'imagen' => $_FILES['imagen'],
        'texto' => $_POST['texto'],
        'discografica_id' => $_POST['discografica_id'],
        'productor_id' => $_POST['productor_id'],
        'genero_id' => $_POST['genero_id']
    ];

    if (!validarDatos($datos_cd)) {
        header("Location: ../panel.php");
        exit;
    }

    $datos_cd['imagen'] = guardarImagen($datos_cd['imagen']);

    try {
        // Crear una instancia de la clase Cds y pasar la conexión a la base de datos
        $cd = new Cds($db);
        
        // Intentar crear el CD
        $creado = $cd->crear($datos_cd);

        if ($creado) {
            $_SESSION['mensajeExito'] = "El CD se creó exitosamente.";
        } else {
            $_SESSION['mensajeError'] = "Ocurrió un error al tratar de crear el CD.";
        }
    } catch (\Exception $e) {
        $_SESSION['mensajeError'] = "Ocurrió un error inesperado al tratar de crear el CD.";
    }
}

header("Location: ../panel.php");
exit;
?>