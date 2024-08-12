<?php
session_start();

require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Titulos.php';

$titulosCDs = new Titulos($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_cd'])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmar Eliminación de CD</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
    </head>

    <div class="content">
        <h1>Confirmar Eliminación de CD</h1>

        <form method="POST" action="../acciones/eliminar-cd.php">
            <input type="hidden" name="cd_id" value="<?php echo htmlspecialchars($_POST['cd_id']); ?>">

            <p>¿Está seguro de que desea eliminar el CD seleccionado?</p>

            <div class="button-container">
                <input type="submit" name="confirm_delete" value="Confirmar Eliminación">
                <a href="../panel.php">Cancelar</a>
            </div>
        </form>
    </div>
    <?php
    exit();
}

$cds = $titulosCDs->obtenerTodosLosCDs();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar CD</title>
    <link rel="icon" href="../../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

<div class="content">
    <h1>Eliminar CD</h1>

    <form method="POST" action="">
        <label for="cd_id">Seleccione el CD a eliminar:</label>
        <select id="cd_id" name="cd_id" required>
            <?php
            foreach ($cds as $cd) {
                echo "<option value='{$cd['cd_id']}'>{$cd['cd_id']} - {$cd['titulo']}</option>";
            }
            ?>
        </select><br><br>

        <div class="button-container">
            <input type="submit" name="delete_cd" value="Eliminar CD">
            <a href="../panel.php">Volver</a>
        </div>
    </form>
</div>