<?php
class Titulos
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function obtenerTodosLosCDs()
    {
        $stmt = $this->db->query("SELECT cd_id, titulo FROM cds");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>