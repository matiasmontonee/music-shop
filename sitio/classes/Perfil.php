<?php
class Perfil
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerDatosUsuario($correoElectronico)
    {
        $consulta = "SELECT * FROM usuarios WHERE correo_electronico = :correo";
        $statement = $this->conexion->prepare($consulta);
        $statement->bindParam(':correo', $correoElectronico, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerNombreRol($rolId)
    {
        $consulta = "SELECT nombre FROM roles WHERE rol_id = :rol";
        $statement = $this->conexion->prepare($consulta);
        $statement->bindParam(':rol', $rolId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>