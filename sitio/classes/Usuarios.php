<?php
class Usuarios
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function obtenerUsuarios()
    {
        $stmt = $this->db->query("SELECT u.usuario_id, u.correo_electronico, u.nombre, r.nombre as rol_nombre FROM usuarios u JOIN roles r ON u.rol_id = r.rol_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>