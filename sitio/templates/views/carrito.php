<?php
require_once __DIR__ . '/../../classes/ObtenerCds.php';
require_once __DIR__ . '/../../classes/Conexion.php';
require_once __DIR__ . '/../../classes/Cds.php';
require_once __DIR__ . '/../../classes/Carrito.php';

// Verifica si existe la variable de sesión para el carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Verifica si existe la variable de sesión para la cantidad de cada CD en el carrito
if (!isset($_SESSION['carrito_cantidad'])) {
    $_SESSION['carrito_cantidad'] = array();
}

// Verifica si se ha enviado una solicitud para agregar o eliminar un CD del carrito
if (isset($_POST['agregar_al_carrito']) && isset($_POST['cd_id'])) {
    $cd_id = $_POST['cd_id'];

    if (!isset($_SESSION['carrito_cantidad'][$cd_id])) {
        // Si el CD no está en el carrito, agrega el ID del CD al carrito y establece la cantidad en 1
        $_SESSION['carrito_cantidad'][$cd_id] = 1;
        $_SESSION['carrito'][] = $cd_id;
    } else {
        // Si el CD ya está en el carrito, incrementa la cantidad
        $_SESSION['carrito_cantidad'][$cd_id]++;
    }
} elseif (isset($_POST['eliminar_del_carrito']) && isset($_POST['cd_id'])) {
    $cd_id = $_POST['cd_id'];

    // Elimina completamente el CD del carrito sin importar la cantidad
    $_SESSION['carrito'] = array_diff($_SESSION['carrito'], array($cd_id));
    unset($_SESSION['carrito_cantidad'][$cd_id]);

} elseif (isset($_POST['incrementar_cantidad']) && isset($_POST['cd_id'])) {
    $cd_id = $_POST['cd_id'];
    $_SESSION['carrito_cantidad'][$cd_id]++;
} elseif (isset($_POST['decrementar_cantidad']) && isset($_POST['cd_id'])) {
    $cd_id = $_POST['cd_id'];

    if ($_SESSION['carrito_cantidad'][$cd_id] > 1) {
        // Si la cantidad es mayor a 1, decrementa la cantidad
        $_SESSION['carrito_cantidad'][$cd_id]--;
    } else {
        // Si la cantidad es 1, elimina completamente el CD del carrito
        $_SESSION['carrito'] = array_diff($_SESSION['carrito'], array($cd_id));
        unset($_SESSION['carrito_cantidad'][$cd_id]);
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'vaciar_carrito') {
    // Vacía el carrito
    $_SESSION['carrito'] = array();
    $_SESSION['carrito_cantidad'] = array();
    // Redirige para evitar el reenvío del formulario al recargar la página
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
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

function calcularTotal($cdsEnCarrito) {
    $total = 0;
    foreach ($cdsEnCarrito as $cdEnCarrito) {
        $total += $cdEnCarrito->precio * $_SESSION['carrito_cantidad'][$cdEnCarrito->cd_id];
    }
    return $total;
}

// instancia de la clase para obtener CDs
$obtenerCds = new ObtenerCds($db);
$cdsData = $obtenerCds->obtenerTodosLosCDs();

// Muestra los detalles de los CDs en el carrito
$cdsEnCarrito = obtenerDetallesCarrito($cdsData);

$carrito = new Carrito($db);

if (isset($_POST['finalizar_compra'])) {
    // Procesar la finalización de la compra
    $usuario_id = $_SESSION['usuario_id']; // Asegúrate de tener la variable de sesión del usuario
    $cd_ids = $_SESSION['carrito'];
    $total = calcularTotal($cdsEnCarrito);

    $carrito->finalizarCompra($usuario_id, $total, $cdsEnCarrito);

    // Vacía el carrito después de la compra
    $_SESSION['carrito'] = array();
    $_SESSION['carrito_cantidad'] = array();

    // Redirige para evitar el reenvío del formulario al recargar la página
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<article id="carrito">
    <header>
        <h1 id="centrar-titulo">Carrito de Compras</h1>
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
                                <th>Precio unitario</th>
                                <th>Precio total</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cdsEnCarrito as $cdEnCarrito) : ?>
                                <tr>
                                    <td><img src="<?= $cdEnCarrito->imagen ?>" alt="<?= $cdEnCarrito->titulo ?>"></td>
                                    <td><?= $cdEnCarrito->titulo ?></td>
                                    <td>$<?= $cdEnCarrito->precio ?></td>
                                    <td>$<?= $cdEnCarrito->precio * $_SESSION['carrito_cantidad'][$cdEnCarrito->cd_id] ?></td>
                                    <td>
                                        <div class="cantidad-container">
                                            <form method="post" action="">
                                                <input type="hidden" name="cd_id" value="<?= $cdEnCarrito->cd_id ?>">
                                                <button type="submit" name="decrementar_cantidad" class="change-quantity">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </form>
                                            <span class="quantity-input"><?= $_SESSION['carrito_cantidad'][$cdEnCarrito->cd_id] ?></span>
                                            <form method="post" action="">
                                                <input type="hidden" name="cd_id" value="<?= $cdEnCarrito->cd_id ?>">
                                                <button type="submit" name="incrementar_cantidad" class="change-quantity">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                            <form method="post" action="">
                                                <input type="hidden" name="cd_id" value="<?= $cdEnCarrito->cd_id ?>">
                                                <button type="submit" name="eliminar_del_carrito" class="eliminar-carrito">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="total-derecha">
                    <h3>Resumen del pedido</h3>
                    <p><strong>Total a pagar: $<?= calcularTotal($cdsEnCarrito) ?></strong></p>
                    
                    <div class="botones-resumen">
                        <form method="post" action="">
                            <input type="hidden" name="accion" value="vaciar_carrito">
                            <button type="submit" class="finalizar-compra">Vaciar Carrito</button>
                            <a href="index.php?seccion=productos" class="finalizar-compra">Seguir Comprando</a>
                        </form>
                    </div>
                    
                    <form action="" method="post">
                        <button type="submit" name="finalizar_compra" class="finalizar-compra">Finalizar Compra</button>
                    </form>
                </div>
            <?php else : ?>
                <p>No hay productos en el carrito.</p>
            <?php endif; ?>
        </main>
    </div>
</article>