<?php
class DetallesCds
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function obtenerDetallesCD($cdId)
    {
        $query = "SELECT cd.*, discograficas.nombre AS discografica_nombre, productores.nombre AS productor_nombre, generos.nombre AS genero_nombre 
                  FROM cds cd 
                  LEFT JOIN discograficas ON cd.discografica_id = discograficas.discografica_id 
                  LEFT JOIN productores ON cd.productor_id = productores.productor_id 
                  LEFT JOIN generos ON cd.genero_id = generos.genero_id 
                  WHERE cd.cd_id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([$cdId]);

        // Fetch
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Cds', [$this->db]);
        return $stmt->fetch();
    }
}
?>