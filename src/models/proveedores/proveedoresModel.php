<?php

// require_once 'models/conexion.php';
class ProveedoresModel
{

    public static function getProveedoresModel($tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla pro
        JOIN ciudad ciu ON pro.idCiudad = ciu.idCiudad
        JOIN provincia prov ON ciu.idProvincia = prov.idProvincia
        ");
        $sql->execute();
        return $sql->fetchAll();

        $sql->close();
    }

    public static function getCiudadModel($tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ta JOIN
                                           provincia prov ON ta.idProvincia = prov.idProvincia
                                            ");
        $sql->execute();

        return $sql->fetchAll();

        $sql->close();
    }

    public static function getProvinciaModel($tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
        $sql->execute();

        return $sql->fetchAll();

        $sql->close();
    }

    public static function agregarProveedorModel($datosModel, $tabla)
    {
        if(!self::ValidarCaracteres($datosModel['nombreProveedor']) or !self::ValidarCaracteres($datosModel['apellidoProveedor'])
            or !self::ValidarCaracteresAlfanume($datosModel['nombreEmpresa'])
            or !self::ValidarEnterosRango($datosModel['telefonoProveedor']) or
            !self::ValidarCaracteresragnoDir($datosModel['direccionProveedor']) or
            !self::ValidarEnterosRango1($datosModel['idCiudad'])) {
            return 'Error';
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreProveedor,apellidoProveedor,nombreEmpresa,telefonoProveedor,direccionProveedor,
            idCiudad)VALUES (:nombreProveedor,:apellidoProveedor,:nombreEmpresa,:telefonoProveedor,:direccionProveedor,
            :idCiudad)");

            $sql->bindParam(':nombreProveedor', $datosModel['nombreProveedor']);
            $sql->bindParam(':apellidoProveedor', $datosModel['apellidoProveedor']);
            $sql->bindParam(':nombreEmpresa', $datosModel['nombreEmpresa']);
            $sql->bindParam(':telefonoProveedor', $datosModel['telefonoProveedor']);
            $sql->bindParam(':direccionProveedor', $datosModel['direccionProveedor']);
            $sql->bindParam(':idCiudad', $datosModel['idCiudad']);

            if ($sql->execute()) {
                return 'success';
            } else {
                return 'error';
            }
        }
    }
    public static function ValidarEnterosRango1($datos){
        $flag = true;
        if(strlen($datos)<0 or strlen($datos)>=11 or is_string($datos)){
            echo json_encode(strlen($datos));
            $flag = false;
        }
        return $flag;
    }


    public static function ValidarEnterosRango($datos){
        $flag = true;

        if(strlen($datos)<7 or strlen($datos)>10 or is_string($datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }

    public static function ValidarCaracteresragnoDir($datos){
        $flag = true;
        if(strlen($datos)<15 or strlen($datos)>30 or ctype_alnum($datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }

    public static function ValidarCaracteres($datos){
        $flag = true;
            if(strlen($datos)<3 or strlen($datos)>20 or is_numeric($datos)){
               echo json_encode($datos);
                $flag = false;
            }
        return $flag;
    }

    public static function ValidarCaracteresAlfanume($datos){
        $flag = true;
        if(strlen($datos)<3 or strlen($datos)>30 or ctype_alnum($datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }








    public static function validarProveedorModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT nombreEmpresa FROM $tabla WHERE nombreEmpresa = :nombreEmpresa");
        $sql->bindParam(':nombreEmpresa', $datosModel);

        $sql->execute();

        return $sql->fetch();


    }

    public static function editarProveedoresModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ta
        JOIN ciudad ciu ON ta.idCiudad = ciu.idCiudad
        WHERE idProveedor = :idProveedor");
        $sql->bindParam(":idProveedor", $datosModel);
        $sql->execute();

        return $sql->fetchAll();
        $sql->close();
    }

    public static function actualizarProveedorModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("UPDATE $tabla SET nombreProveedor=:nombreProveedor,apellidoProveedor=:apellidoProveedor,nombreEmpresa=:nombreEmpresa,telefonoProveedor=:telefonoProveedor,direccionProveedor=:direccionProveedor,idCiudad=:idCiudad WHERE idProveedor=:idProveedor");

        $sql->bindParam(":nombreProveedor", $datosModel['nombreProveedor']);
        $sql->bindParam(":apellidoProveedor", $datosModel['apellidoProveedor']);
        $sql->bindParam(":nombreEmpresa", $datosModel['nombreEmpresa']);
        $sql->bindParam(":telefonoProveedor", $datosModel['telefonoProveedor']);
        $sql->bindParam(":direccionProveedor", $datosModel['direccionProveedor']);
        $sql->bindParam(":idCiudad", $datosModel['idCiudad']);
        $sql->bindParam(":idProveedor", $datosModel['idProveedor']);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();

    }

    public static function deleteProveedoresModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idProveedor = :idProveedor");

        $sql->bindParam(':idProveedor', $datosModel);

        if ($sql->execute()) {
            return 'success';
        }
    }
}
