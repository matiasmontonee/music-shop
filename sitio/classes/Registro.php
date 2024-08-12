<?php
class Registro
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function registrarUsuario($correo, $contrasena, $confirmarContrasena, $nombre)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($correo) || empty($contrasena) || empty($confirmarContrasena)) {
                return "Todos los campos son obligatorios. Por favor, complétalos.";
            }

            // Verificar si la contraseña y la confirmación coinciden
            if ($contrasena !== $confirmarContrasena) {
                return "La contraseña y la confirmación no coinciden.";
            }

            // Verificar si el correo ya está registrado
            $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo_electronico = ?");
            $stmt->execute([$correo]);

            if ($stmt->rowCount() > 0) {
                return "El correo electrónico ya está registrado. Por favor, elige otro.";
            }

            // Hash de la contraseña
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

            // Insertar nuevo usuario en la base de datos con rol de usuario (rol_id = 2)
            $sql = "INSERT INTO usuarios (correo_electronico, contrasena, rol_id, nombre) VALUES (?, ?, 2, ?)";
            $stmt = $this->db->prepare($sql);

            if ($stmt->execute([$correo, $hashed_password, $nombre])) {
                return true; // Registro exitoso
            } else {
                return "Error al registrar usuario: " . $stmt->errorInfo()[2];
            }
        }
    }
}
?>