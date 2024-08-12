<?php
session_start();

// inicio de sesión
$usuarioHaIniciadoSesion = isset($_SESSION["correo_electronico"]);
?>

<header class="header">
    <nav class="navbar">
        <h1>Music Shop</h1>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php?seccion=home" class="homeBtn">Home</a></li>
                <li><a href="index.php?seccion=productos" class="productosBtn">Productos</a></li>
                <li><a href="index.php?seccion=contacto" class="contactoBtn">Contacto</a></li>
                <li>
                <?php if (!$usuarioHaIniciadoSesion): ?>
                    <a href="index.php?seccion=login" class="contactoBtn">Login</a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="index.php?seccion=carrito" class="carritoBtn">
                        <i class="fas fa-shopping-cart"></i> 
                        <span id="carritoCantidad">
                            <?php
                            
                            if (isset($_SESSION['carrito'])) {
                               
                                echo array_sum($_SESSION['carrito_cantidad']);
                                
                            } else {
                                echo '0';
                            }
                            ?>
                        </span>
                    </a>
                </li>
                <li>
                    <?php if ($usuarioHaIniciadoSesion): ?>
                        <a href="index.php?seccion=perfil" class="contactoBtn">
                            <i class="fas fa-user"></i>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script>
    function toggleMenu() {
        var menu = document.querySelector('.navbar ul');
        menu.classList.toggle('active');
    }
</script>