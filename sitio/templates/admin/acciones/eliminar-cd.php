<?php
session_start();

require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Cds.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recopilar el ID del CD a eliminar
    $cd_id = $_POST['cd_id'];

    try {
        $cd = new Cds($db);

        // Llamar al método eliminarCD para eliminar el CD
        $eliminado = $cd->eliminarCD($cd_id);

        if ($eliminado) {
            $_SESSION['mensajeExito'] = "El CD se eliminó exitosamente.";
        } else {
            $_SESSION['mensajeError'] = "Ocurrió un error al tratar de eliminar el CD.";
        }
    } catch (\Exception $e) {
        $_SESSION['mensajeError'] = "Ocurrió un error inesperado al tratar de eliminar el CD.";
    }
}

header("Location: ../panel.php");
exit;
?>