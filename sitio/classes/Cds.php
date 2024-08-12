<?php
require_once __DIR__ . '/./Conexion.php';

class Cds {
    private $db;

    // recibe la conexión como parámetro
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // crear un nuevo CD
    public function crear($datos) {
        // Verificar si todos los datos requeridos están establecidos
        if (!isset($datos['titulo'], $datos['sinopsis'], $datos['precio'], $datos['imagen'], $datos['texto'], $datos['discografica_id'], $datos['productor_id'], $datos['genero_id'])) {
            return false;
        }

        // Preparar y ejecutar la declaración SQL para insertar los datos del CD en la base de datos
        $stmt = $this->db->prepare("INSERT INTO cds (titulo, sinopsis, precio, imagen, texto, discografica_id, productor_id, genero_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $datos['titulo'],
            $datos['sinopsis'],
            $datos['precio'],
            'assets/imgs/' . $datos['imagen'],
            $datos['texto'],
            $datos['discografica_id'],
            $datos['productor_id'],
            $datos['genero_id']
        ]);

        return $stmt->rowCount() > 0;
    }

    // Método para eliminar un CD
    public function eliminarCD($cd_id) {
        // Preparar y ejecutar la declaración SQL para eliminar un CD por su ID
        $stmt = $this->db->prepare("DELETE FROM cds WHERE cd_id = ?");
        $stmt->execute([$cd_id]);

        return $stmt->rowCount() > 0;
    }

    // Método para editar un CD
    public function editarCD($cd_id, $titulo, $sinopsis, $texto, $imagen, $discografica_id, $productor_id, $genero_id, $precio) {
        // Ruta donde se almacenará la imagen
        $rutaImagen = 'assets/imgs/' . $imagen['name'];
        move_uploaded_file($imagen['tmp_name'], $rutaImagen);

        // Preparar y ejecutar la declaración SQL para actualizar los datos de un CD
        $stmt = $this->db->prepare("UPDATE cds SET titulo = ?, sinopsis = ?, texto = ?, imagen = ?, discografica_id = ?, productor_id = ?, genero_id = ?, precio = ? WHERE cd_id = ?");

        $stmt->execute([$titulo, $sinopsis, $texto, $rutaImagen, $discografica_id, $productor_id, $genero_id, $precio, $cd_id]);

        return $stmt->rowCount() > 0;
    }
}

// Crear una instancia de la clase Cds y pasar la conexión a la base de datos
$cds = new Cds($db);
?>