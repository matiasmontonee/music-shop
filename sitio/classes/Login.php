<?php
class Login
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function iniciarSesion($correo, $contrasena)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($correo) || empty($contrasena)) {
            return "Todos los campos son obligatorios. Por favor, complétalos.";
        }

        // Consultar a la base el correo 
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo_electronico = ?");
        $stmt->execute([$correo]);

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch();
            $hash_guardado = $usuario["contrasena"];
            $rol_id = $usuario["rol_id"];
            $usuario_id = $usuario["usuario_id"];


            if (password_verify($contrasena, $hash_guardado)) {
                $_SESSION["correo_electronico"] = $correo;
                $_SESSION["usuario_id"] = $usuario_id;
                $_SESSION["rol_id"] = $rol_id;
                if ($rol_id == 1) { 
                    header("Location: templates/admin/panel.php");
                    exit();
                } else {
                    header("Location: index.php"); 
                    exit();
                }
            } else {
                return "Correo electrónico o contraseña incorrectos. Intenta nuevamente.";
            }
        } else {
            return "Correo electrónico o contraseña incorrectos. Intenta nuevamente.";
        }
    }
}
}
?>