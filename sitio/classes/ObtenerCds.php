<?php
class ObtenerCds
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function obtenerTodosLosCDs()
    {
        $consulta = "SELECT cd.*, discograficas.nombre AS discografica_nombre FROM cds cd LEFT JOIN discograficas ON cd.discografica_id = discograficas.discografica_id";
        $stmt = $this->db->prepare($consulta);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Cds', [$this->db]);
        return $stmt->fetchAll();
    }
}
?>