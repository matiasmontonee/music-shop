<?php
require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Usuarios.php';
require_once __DIR__ . '/../../../classes/Carrito.php';

$compras = new Carrito($db);

$listaCompras = $compras->obtenerCompras();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
    <link rel="icon" href="../../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

    <h2 class="lista-usuarios">Lista de Compras</h2>

    <div class="centrado">
        <table>
            <thead>
                <tr>
                    <th>Nro Factura</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaCompras as $compra): ?>
                    <tr>
                        <td><?php echo $compra['compra_id']; ?></td>
                        <td><?php echo $compra['fecha']; ?></td>
                        <td><?php echo $compra['nombre']; ?></td>
                        <td><?php echo $compra['total']; ?></td>
                        <td>
                            <a class="cd-button" href="detalleCompra.php?compra_id=<?= $compra['compra_id'] ?>&fecha=<?= $compra['fecha'] ?>&nombre=<?= $compra['nombre'] ?>&total=<?= $compra['total'] ?>"><strong>Ver Compra</strong></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="button-container-volver">
        <a href="../panel.php">Volver</a>
    </div>