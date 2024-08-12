<?php
session_start();

require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Abm.php';

$consultasBD = new Abm($db);

$discograficas = $consultasBD->obtenerDiscograficas();
$productores = $consultasBD->obtenerProductores();
$generos = $consultasBD->obtenerGeneros();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar CD</title>
    <link rel="icon" href="../../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

<div class="content">
    <h1>Agregar CD</h1>

    <form method="POST" action="../acciones/agregar-cd.php" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="sinopsis">Sinopsis:</label>
        <textarea id="sinopsis" name="sinopsis" rows="3" cols="88" required></textarea><br><br>

        <label for="texto">Texto:</label>
        <textarea id="texto" name="texto" rows="3" cols="88" required></textarea><br><br>

        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>

        <label for="discografica_id">Discográfica:</label>
        <select id="discografica_id" name="discografica_id" required>
            <?php
            foreach ($discograficas as $discografica) {
                echo "<option value='{$discografica['discografica_id']}'>{$discografica['nombre']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="productor_id">Productor:</label>
        <select id="productor_id" name="productor_id" required>
            <?php
            foreach ($productores as $productor) {
                echo "<option value='{$productor['productor_id']}'>{$productor['nombre']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="genero_id">Género:</label>
        <select id="genero_id" name="genero_id" required>
            <?php
            foreach ($generos as $genero) {
                echo "<option value='{$genero['genero_id']}'>{$genero['nombre']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required><br><br>
        
        <div class="button-container">
            <input type="submit" value="Agregar CD">
            <a href="../panel.php">Volver</a>
        </div>
    </form>
</div>