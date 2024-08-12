<?php
class Conexion {
    private $db;

    // Constructor que recibe parámetros para la conexión y establece la conexión a la base de datos
    public function __construct($host, $dbName, $charset, $user, $pass) {
        // Definir el DSN (Data Source Name) para la conexión PDO
        $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";

        try {
            // Intentar establecer la conexión a la base de datos
            $this->db = new PDO($dsn, $user, $pass);

            // Configurar el modo de errores para que se arrojen excepciones en caso de errores
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // En caso de error al conectar, mostrar un mensaje y terminar la ejecución del script
            echo "Error al conectar con la base de datos. Por favor, intenta de nuevo más tarde. ";
            echo "El error es: " . $e->getMessage();
            exit();
        }
    }

    // Método para obtener la conexión a la base de datos
    public function obtenerConexion() {
        return $this->db;
    }
}

// Uso de la clase para establecer la conexión a la base de datos
$conexion = new Conexion("localhost", "dw3_montone_guastavino", "utf8mb4", "root", "");
$db = $conexion->obtenerConexion();
?>