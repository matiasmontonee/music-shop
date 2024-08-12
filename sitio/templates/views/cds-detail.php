<?php
require_once __DIR__ . '/../../classes/Cds.php';
require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/DetallesCds.php';
require_once __DIR__ . '/../../classes/Login.php';

// crear instancia de clase para obtener detalles 
$detallesCD = new DetallesCds($db);

// verifica ID de CD en la URL
if (isset($_GET['cd_id'])) {
    $cdId = intval($_GET['cd_id']);
    $foundCd = $detallesCD->obtenerDetallesCD($cdId);
}
?>

<main class="bodyFondoCds">
    <div class="cd-container">
        <?php
        // Mostrar los detalles del CD si se encontró
        if (isset($foundCd)) {
            ?>
            <article id="detail">
                <div class="cd-card-details">
                    <div class="cd-card-details-left">
                        <img src="<?= $foundCd->imagen ?>" alt="<?= $foundCd->titulo ?>">
                        <p><strong>Precio: </strong>$<?= $foundCd->precio ?></p>
                        <form method="post" action="index.php?seccion=carrito">
                            <input type="hidden" name="cd_id" value="<?= $foundCd->cd_id ?>">
                            <div class="button-container">
                                <?php
                                // Verificar si el usuario está autenticado
                                if (!isset($_SESSION["correo_electronico"])) {
                                ?>
                                    <button type="button" class="cd-button" onclick="mostrarMensaje()">Agregar al carrito</button>
                                <?php
                                } else {
                                ?>
                                    <button type="submit" class="cd-button" name="agregar_al_carrito">Agregar al carrito</button>
                                <?php
                                }
                                ?>
                                <a href="index.php?seccion=productos" class="cd-button">Volver</a>
                            </div>
                        </form>
                    </div>
                    <div class="cd-card-details-right">
                        <h2><?= $foundCd->titulo ?></h2>
                        <ul>
                            <li><strong>Discográfica:</strong> <?= $foundCd->discografica_nombre ?></li>
                            <li><strong>Productor:</strong> <?= $foundCd->productor_nombre ?></li>
                            <li><strong>Género:</strong> <?= $foundCd->genero_nombre ?></li>
                            <li><?= $foundCd->texto ?></li>
                            <span id="mensaje-sesion">Por favor, inicia sesión antes de agregar productos al carrito.</span>
                        </ul>
                    </div>
                </div>
            </article>
            <?php
        } else {
            echo '<p>CD no encontrado</p>';
        }
        ?>
    </div>
</main>

<script>
    function mostrarMensaje() {
        document.getElementById("mensaje-sesion").style.display = "inline";
    }
</script>