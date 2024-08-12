<?php
require_once __DIR__ . '/../../classes/Cds.php';
require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/ObtenerCds.php';
require_once __DIR__ . '/../../classes/Login.php';

// instancia de la clase para obtener CDs
$obtenerCds = new ObtenerCds($db);
$cdsData = $obtenerCds->obtenerTodosLosCDs();

?>

<article id="list">
    <main class="bodyFondoCds">
        <div class="cd-container">
            <span id="mensaje-sesion">Por favor, inicia sesión antes de agregar productos al carrito.</span>
            <ul class="cd-list">
                <?php
                // recorre los CDs y los muestra
                foreach ($cdsData as $cd) {
                ?>
                    <li class="cd-card">
                        <a href="index.php?seccion=detalle&cd_id=<?= $cd->cd_id ?>">
                            <img src="<?= $cd->imagen ?>" alt="<?= $cd->titulo ?>" class="cd-image">
                        </a>
                        <div class="cd-details">
                            <div class="cd-title"><?= $cd->titulo ?></div>
                            <div class="cd-sinopsis"><?= $cd->sinopsis ?></div>
                            <div class="cd-precio">$<?= $cd->precio ?></div>

                            <form method="post" action="index.php?seccion=carrito">
                                <input type="hidden" name="cd_id" value="<?= $cd->cd_id ?>">
                                <?php
                                // Verificar si el usuario está autenticado
                                if (!isset($_SESSION["correo_electronico"])) {
                                ?>
                                    <button type="button" class="cd-button" onclick="mostrarMensaje()">Agregar al carrito</button>
                                    
                                <?php
                                } else {
                                ?>
                                    <button type="submit" name="agregar_al_carrito" class="cd-button">Agregar al carrito</button>
                                <?php
                                }
                                ?>
                                <a class="cd-button" href="index.php?seccion=detalle&cd_id=<?= $cd->cd_id ?>"><strong>Ver Detalle</strong></a>
                            </form>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </main>
</article>

<script>
    function mostrarMensaje() {
        document.getElementById("mensaje-sesion").style.display = "inline";
    }
</script>