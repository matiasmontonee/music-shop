<?php
require_once __DIR__ . '/../../../classes/ObtenerCds.php';
require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Cds.php';
require_once __DIR__ . '/../../../classes/Carrito.php';

if (isset($_GET['compra_id'])) {
    $compra_id = $_GET['compra_id'];

} 
if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
} 
if (isset($_GET['total'])) {
    $total = $_GET['total'];
} 
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
} 

function obtenerDetallesCarrito($cdsData) {
    $cdsEnCarrito = array();
    foreach ($_SESSION['carrito'] as $cd_id) {
        foreach ($cdsData as $cd) {
            if ($cd->cd_id == $cd_id) {
                $cdsEnCarrito[] = $cd;
                break;
            }
        }
    }
    return $cdsEnCarrito;
}

// instancia de la clase para obtener CDs
$obtenerCdsdeCompra = new Carrito($db);
$cdsEnCarrito = $obtenerCdsdeCompra->obtenerDetalleCompra($compra_id);

// Muestra los detalles de los CDs en el carrito
$carrito = new Carrito($db);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="icon" href="../../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

<article id="carrito">
    <header>
        <h1 id="centrar-titulo">Detalle de Compra</h1>
    </header>
    <div class="centrar-contenido">
        <main class="bodyFondoCds">
            
            <?php if (!empty($cdsEnCarrito)) : ?>
                <div class="carrito-izquierda">
                    <table>
                        <thead>
                            <tr>
                                <th>Portada</th>
                                <th>Álbum</th>
                                <th>Cantidad</th>
                                <th>Precio total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cdsEnCarrito as $cdEnCarrito) : ?>

                                <tr>
                                    <td><img src="../../../<?= $cdEnCarrito["imagen"] ?>" alt="<?= $cdEnCarrito["titulo"] ?>"></td>
                                    <td><?= $cdEnCarrito["titulo"] ?></td>
                                    <td><?= $cdEnCarrito["cantidad"] ?></td>
                                    <td>$<?= $cdEnCarrito["precio_total"] ?></td>
                                </tr>
                            <?php endforeach;
                         ?>
                        </tbody>
                    </table>
                </div>
                <div class="total-derecha">
                    <h3>Resumen del pedido</h3>
                    <div>
                        <p>Nro Fc: <?= $compra_id ?> </p>
                        <p>Fecha: <?= $fecha ?></p>
                        <p>Cliente: <?= $nombre ?></p>
                    
                    </div>
                    <p><strong>Total pagado: $<?= $total ?></strong></p>
                </div>

                <div class="button-container-volver">
                    <a href="compras.php">Volver</a>
                </div>

            <?php else : ?>
                <p>No hay cds en esta compra.</p>
            <?php endif; ?>
        </main>
    </div>
</article>