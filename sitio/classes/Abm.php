<?php
class Abm {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerDiscograficas() {
        $stmt = $this->db->query("SELECT discografica_id, nombre FROM discograficas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductores() {
        $stmt = $this->db->query("SELECT productor_id, nombre FROM productores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerGeneros() {
        $stmt = $this->db->query("SELECT genero_id, nombre FROM generos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$consultasBD = new Abm($db);

$discograficas = $consultasBD->obtenerDiscograficas();

$productores = $consultasBD->obtenerProductores();

$generos = $consultasBD->obtenerGeneros();
?>