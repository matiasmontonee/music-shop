<?php

require_once __DIR__ . '/./Conexion.php';

class Carrito
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

public function finalizarCompra($usuario_id, $precio_total, $cdsEnCarrito)
{
    $fecha = date('Y-m-d H:i:s');
   
    
    // Inserta la información de la compra en la tabla 'compras' y obtén el ID de la compra
    $sqlCompra = "INSERT INTO compras (usuario_id, fecha, total) VALUES (:usuario_id, :fecha, :total)";
    $stmtCompra = $this->db->prepare($sqlCompra);
    $stmtCompra->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
    $stmtCompra->bindParam(":total", $precio_total, PDO::PARAM_STR);
    $stmtCompra->bindParam(":fecha", $fecha, PDO::PARAM_STR);
    $stmtCompra->execute();
    $compra_id = $this->db->lastInsertId();
    $stmtCompra->closeCursor();  // Cerrar el cursor para futuras consultas
    
    // Inserta los detalles de los CDs comprados en la tabla intermedia 'cds_compras'
    $sqlDetallesCompra = "INSERT INTO cds_compras (cd_id, compras_id, cantidad, precio_total) VALUES (:cd_id, :compra_id, :cantidad, :precio_total)";
    $stmtDetallesCompra = $this->db->prepare($sqlDetallesCompra);
    
    foreach ($cdsEnCarrito as $cdEnCarrito) {
        $cd_id = $cdEnCarrito->cd_id;
        $cantidad = $_SESSION['carrito_cantidad'][$cdEnCarrito->cd_id];
        $precio_total = $cdEnCarrito->precio * $cantidad;
        
        $stmtDetallesCompra->bindParam(":cd_id", $cd_id, PDO::PARAM_INT);
        $stmtDetallesCompra->bindParam(":compra_id", $compra_id, PDO::PARAM_INT);
        $stmtDetallesCompra->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmtDetallesCompra->bindParam(":precio_total", $precio_total, PDO::PARAM_STR);
        $stmtDetallesCompra->execute();
    }
    
    $stmtDetallesCompra->closeCursor();  // Cerrar el cursor para futuras consultas
}

public function obtenerCompras()
    {
        $stmt = $this->db->query("SELECT compras.compra_id, compras.usuario_id, compras.fecha, compras.total, usuarios.nombre FROM compras  JOIN usuarios  ON usuarios.usuario_id = compras.usuario_id ORDER BY usuarios.usuario_id, compras.compra_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDetalleCompra($compra_id)
    {
        $stmt = $this->db->prepare("SELECT cds_compras.cd_id, cds_compras.compras_id, cds_compras.precio_total, cds_compras.cantidad, cds.titulo, cds.imagen 
            FROM cds_compras  
            JOIN cds  ON cds.cd_id = cds_compras.cd_id
            WHERE cds_compras.compras_id = :compra_id ");
        $stmt->bindValue(":compra_id", $compra_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
?>