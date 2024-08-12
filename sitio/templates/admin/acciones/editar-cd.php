<?php
// Iniciar la sesión
session_start();

// Incluir archivos necesarios
require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Cds.php';

// validar datos 
function validarDatos($titulo, $sinopsis, $texto, $imagen, $discografica_id, $productor_id, $genero_id, $precio)
{
    if (
        empty($titulo) ||
        empty($sinopsis) ||
        empty($texto) ||
        empty($imagen) ||
        empty($discografica_id) ||
        empty($productor_id) ||
        empty($genero_id) ||
        empty($precio)
    ) {
        $_SESSION['mensajeError'] = "Todos los campos son obligatorios. Por favor, completa todos los campos.";
        header("Location: ../panel.php");
        exit;
    }
}

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cd_id = $_POST['cd_id'];
    $titulo = $_POST['titulo'];
    $sinopsis = $_POST['sinopsis'];
    $texto = $_POST['texto'];
    $imagen = $_FILES['imagen'];
    $discografica_id = $_POST['discografica_id'];
    $productor_id = $_POST['productor_id'];
    $genero_id = $_POST['genero_id'];
    $precio = $_POST['precio'];

    // Validar datos antes de continuar
    validarDatos($titulo, $sinopsis, $texto, $imagen, $discografica_id, $productor_id, $genero_id, $precio);

    try {
        $cd = new Cds($db);

        // actualizar información del CD
        $actualizado = $cd->editarCD($cd_id, $titulo, $sinopsis, $texto, $imagen, $discografica_id, $productor_id, $genero_id, $precio);

        if ($actualizado) {
            $_SESSION['mensajeExito'] = "El CD se actualizó exitosamente.";
        } else {
            $_SESSION['mensajeError'] = "Ocurrió un error al tratar de actualizar el CD.";
        }
    } catch (\Exception $e) {
        $_SESSION['mensajeError'] = "Ocurrió un error inesperado al tratar de actualizar el CD.";
    }
}

// Redirigir al panel después de procesar la solicitud
header("Location: ../panel.php");
exit;
?>