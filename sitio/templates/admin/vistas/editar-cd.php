<?php
session_start();

require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Titulos.php';
require_once __DIR__ . '/../../../classes/Abm.php';

$titulosCDs = new Titulos($db);
$consultasBD = new Abm($db);

$discograficas = $consultasBD->obtenerDiscograficas();
$productores = $consultasBD->obtenerProductores();
$generos = $consultasBD->obtenerGeneros();

// Variables para almacenar la información del CD seleccionado
$cd_info = array(
    'titulo' => '',
    'sinopsis' => '',
    'texto' => '',
    'imagen' => '',
    'discografica_id' => '',
    'productor_id' => '',
    'genero_id' => '',
    'precio' => ''
);

// Verificar si se ha seleccionado un CD y todos los campos están llenos
if (isset($_POST['cd_id'])) {
    // Obtener el ID del CD seleccionado
    $cd_id_seleccionado = $_POST['cd_id'];

    // Consultar la información del CD seleccionado
    $stmt_cd = $db->prepare("SELECT * FROM cds WHERE cd_id = :cd_id");
    $stmt_cd->bindParam(':cd_id', $cd_id_seleccionado);
    $stmt_cd->execute();
    $cd_info = $stmt_cd->fetch(PDO::FETCH_ASSOC);

    // Verificar que todos los campos estén llenos
    $campos_validos = true;
    foreach ($cd_info as $value) {
        if (empty($value)) {
            $campos_validos = false;
            break;
        }
    }

    // Si los campos no están llenos, asignamos valores predeterminados
    if (!$campos_validos) {
        $cd_info = array(
            'titulo' => '',
            'sinopsis' => '',
            'texto' => '',
            'imagen' => '',
            'discografica_id' => '',
            'productor_id' => '',
            'genero_id' => '',
            'precio' => ''
        );
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar CD</title>
    <link rel="icon" href="../../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

<div class="content">
    <h1>Editar CD</h1>

    <form method="POST" action="../acciones/editar-cd.php" enctype="multipart/form-data" id="editarCdForm">
        <label for="cd_id">Seleccione el CD a editar:</label>
        <select id="cd_id" name="cd_id" onchange="mostrarDatos()">
            <?php
            $cds = $titulosCDs->obtenerTodosLosCDs();

            foreach ($cds as $cd) {
                $selected = ($cd['cd_id'] == $cd_info['cd_id']) ? 'selected' : '';
                echo "<option value='{$cd['cd_id']}' $selected>{$cd['cd_id']} - {$cd['titulo']}</option>";
            }
            ?>
        </select><br><br>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= $cd_info['titulo'] ?>" required><br><br>

        <label for="sinopsis">Sinopsis:</label>
        <textarea id="sinopsis" name="sinopsis" rows="3" cols="88" required><?= $cd_info['sinopsis'] ?></textarea><br><br>

        <label for="texto">Texto:</label>
        <textarea id="texto" name="texto" rows="3" cols="88" required><?= $cd_info['texto'] ?></textarea><br><br>

        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>

        <label for="discografica_id">Discográfica:</label>
        <select id="discografica_id" name="discografica_id" required>
            <?php
            foreach ($discograficas as $discografica) {
                $selected = ($discografica['discografica_id'] == $cd_info['discografica_id']) ? 'selected' : '';
                echo "<option value='{$discografica['discografica_id']}' $selected>{$discografica['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="productor_id">Productor:</label>
        <select id="productor_id" name="productor_id" required>
            <?php
            foreach ($productores as $productor) {
                $selected = ($productor['productor_id'] == $cd_info['productor_id']) ? 'selected' : '';
                echo "<option value='{$productor['productor_id']}' $selected>{$productor['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="genero_id">Género:</label>
        <select id="genero_id" name="genero_id" required>
            <?php
            foreach ($generos as $genero) {
                $selected = ($genero['genero_id'] == $cd_info['genero_id']) ? 'selected' : '';
                echo "<option value='{$genero['genero_id']}' $selected>{$genero['nombre']}</option>";
            }
            ?>
        </select><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?= $cd_info['precio'] ?>" required><br><br>

        <div class="button-container">
            <input type="submit" value="Editar CD">
            <a href="../panel.php">Volver</a>
        </div>
    </form>
</div>

<script>
    function mostrarDatos() {
        var formulario = document.getElementById('editarCdForm');
        formulario.action = ''; 
        formulario.submit();
    }
</script>