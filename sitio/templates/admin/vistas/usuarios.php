<?php
require_once __DIR__ . '/../../../classes/Conexion.php';
require_once __DIR__ . '/../../../classes/Usuarios.php';

$usuarios = new Usuarios($db);

$listaUsuarios = $usuarios->obtenerUsuarios();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="icon" href="../../../favicon.ico" sizes="any">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

    <h2 class="lista-usuarios">Lista de Usuarios Registrados</h2>

    <div class="centrado">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaUsuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['usuario_id']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['correo_electronico']; ?></td>
                        <td><?php echo $usuario['rol_nombre']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="button-container-volver">
        <a href="../panel.php">Volver</a>
    </div>