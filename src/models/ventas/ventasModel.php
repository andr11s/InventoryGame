
<?php
// require_once 'models/conexion.php';
class VentasModel
{

    public static function getFacturaModel($tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT MAX(numFac) AS total FROM $tabla  ");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function getTempModel($tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla te
         JOIN productos prod ON prod.idProducto = te.idProducto
         JOIN clientes cli ON te.idCliente = cli.idCliente ");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function registroFacturaModel($datosModel, $tabla)
    {
        if( !self::ValidarIdentificacion($datosModel['idProducto']) or  !self::ValidarIdentificacion($datosModel['idCliente'])
            or !self::ValidarCantidadess($datosModel['precioVenta'])  or !self::ValidarCantidadess($datosModel['cantidad'])
            or !self::ValidarCantidadess($datosModel['iva']) or !self::ValidarCantidadess($datosModel['totalVenta'])
            or !self::ValidarCantidadess($datosModel['numFac']) or !self::ValidarCantidadess($datosModel['unidad'])
            or !self::ValidarCadenas($datosModel['tipoFactura'])){

            return 'Error';
        }else{

            $sql = Conexion::conectar()->prepare("INSERT INTO   $tabla(idProducto,idCliente,precioVenta,cantidad,iva,totalVenta,numFac,fechaVenta,unidad,tipoFactura)VALUES
                (:idProducto,:idCliente,:precioVenta,:cantidad,:iva,:totalVenta,:numFac,:fechaVenta,:unidad,:tipoFactura) ");

            $sql->bindParam(':idProducto', $datosModel['idProducto']);
            $sql->bindParam(':idCliente', $datosModel['idCliente']);
            $sql->bindParam(':precioVenta', $datosModel['precioVenta']);
            $sql->bindParam(':cantidad', $datosModel['cantidad']);
            $sql->bindParam(':iva', $datosModel['iva']);
            $sql->bindParam(':totalVenta', $datosModel['totalVenta']);
            $sql->bindParam(':numFac', $datosModel['numFac']);
            $sql->bindParam(':fechaVenta', $datosModel['fechaVenta']);
            $sql->bindParam(':unidad', $datosModel['unidad']);
            $sql->bindParam(':tipoFactura', $datosModel['tipoFactura']);

            $sql->execute();
            //
            // verifica el stock
            $idProducto = $datosModel['idProducto'];
            $stock = Conexion::conectar()->prepare("SELECT * FROM inventario WHERE idProducto = $idProducto");
            $stock->execute();
            $resultado = $stock->fetchAll();

            foreach ($resultado as $key) {
                if ($key['cantidadIngresada'] < $datosModel['unidad']) {
                    return 'NoExisteProducto';

                }
            }

            // revisa que sea el mismo cliente
            //
            //
            $cedu = Conexion::conectar()->prepare('SELECT idCliente FROM temp ');
            $cedu->execute();
            $resu = $cedu->fetch();

            if ($resu == ' ') {
                // actualiza el inventario
                //
                $unidad = $datosModel['unidad'];
                $idProducto = $datosModel['idProducto'];
                $sql1 = Conexion::conectar()->prepare("UPDATE inventario SET cantidadIngresada = cantidadIngresada - $unidad  WHERE idProducto = $idProducto");
                $sql1->execute();

                if ($sql->execute()) {
                    return 'success';
                }
            }
            // revisa que sea el mismo cliente
            //
            //
            $cedulaSql = Conexion::conectar()->prepare('SELECT idCliente FROM temp
            WHERE idCliente = :idCliente ');
            $cedulaSql->execute(array(':idCliente' => $datosModel['idCliente'],
            ));
            ///echo json_encode($datosModel);
            $res = $cedulaSql->fetch();
            if (!$res) {
                return 'ErrorNoExisteCliente';

            }
            // revisa que sea el mismo tipo de factura
            //
            //
            $cedulaSql = Conexion::conectar()->prepare('SELECT tipoFactura FROM temp
            WHERE tipoFactura=:tipoFactura');
            $cedulaSql->execute(array(':tipoFactura' => $datosModel['tipoFactura']));
            $res = $cedulaSql->fetch();

            if (!$res) {
                return 'ErrorNoExisteFacturaTipo';

            }

            // // actualiza el inventario
            // //
            $unidad = $datosModel['unidad'];
            $idProducto = $datosModel['idProducto'];

            $sql1 = Conexion::conectar()->prepare("UPDATE inventario SET cantidadIngresada = cantidadIngresada - $unidad  WHERE idProducto = $idProducto");


            if ($sql1->execute()) {
                return 'success';
            }

            $sql->close();
        }
    }


    public static function ValidarIdentificacion($datos){
        $flag=true;

        if($datos<1 or strlen($datos)>11 ){
            echo json_encode($datos);
            $flag = false;
        }
        /*
        if(is_numeric($datos[$i])){
            $flag = false;
        }*/

        return $flag;
    }

    public static function ValidarIdentBD($datoFac,$Numfact){
        $flag=true;
        $sql = Conexion::conectar()->prepare("SELECT  * FROM  administrador where idAdmin= $datoFac");
        if(!$sql->execute()){
            $flag=false;
        }

        $sql1 = Conexion::conectar()->prepare("SELECT  * FROM  detalles where idAdmin= $Numfact");
        if(!$sql1->execute()){
            $flag=false;
        }




        return $flag;
    }


    public static function ValidarCantidadess($datos){
                $flag=true;
                        if($datos<1 or strlen($datos)>11 or  is_string($datos)){
                            echo json_encode($datos);
                            $flag = false;
                        }
                    /*if(is_numeric($datos[$i])){
                        $flag = false;
                    }*/

                    return $flag;
    }

    public static function ValidarCadenas($datos){
        $flag=true;
        $comp1="A";
        $comp2="B";


        if($datos!==$comp1){
            $flag = false;
        }
        return $flag;
    }



    public static function borrarVentasModel($datosModel, $datosControl, $unidad, $tabla)
    {


        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idTemp = :idTemp");
        $sql->bindParam(':idTemp', $datosModel);

        //
        // vuelve la venta atras.
        $sql1 = Conexion::conectar()->prepare("UPDATE inventario SET cantidadIngresada = cantidadIngresada + $unidad  
WHERE idProducto = $datosControl");
        $sql1->execute();

        if ($sql->execute()) {
            return 'success';
        }

    }

    public static function registrarVentasDetallesModel($datosModel, $tabla, $idAdmin, $numFac)
    {
        $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente,idProducto,fechaVenta,precioVenta,cantidadKilos,totalVenta,numFac,tipoFactura)SELECT tem.idCliente,tem.idProducto,tem.fechaVenta,tem.precioVenta,tem.cantidad,tem.totalVenta,tem.numFac,tem.tipoFactura
            FROM temp tem ");

        if ($sql->execute()) {
            $sql = Conexion::conectar()->prepare("INSERT INTO factura( numFac,fechaVenta,idCliente,idAdmin , totalVenta,tipoFactura)SELECT  MAX(det.numFac), det.fechaVenta,det.idCliente, $idAdmin, SUM(det.totalVenta),det.tipoFactura
            FROM detalles det WHERE numFac=$numFac");
            $sql->execute();
            $sql = Conexion::conectar()->prepare("DELETE FROM temp");
            $sql->execute();
            return 'success';
        }
        $sql->close();

    }

    public static function imprimirVentasModel($numFac)
    {
        $sql = Conexion::conectar()->prepare("SELECT  * FROM detalles ta
            JOIN clientes cli ON ta.idCliente=cli.idCliente
            JOIN Productos prod ON prod.idProducto=ta.idProducto
            JOIN Provincia pro ON pro.idProvincia=cli.idProvincia
            JOIN ciudad ciu ON pro.idProvincia=ciu.idProvincia
            WHERE numFac = $numFac");
        $sql->execute();

        return $sql->fetchAll();

    }
    public static function getVentasModel($tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT  * FROM  $tabla ta
               JOIN clientes cli ON ta.idCliente=cli.idCliente");
        $sql->execute();

        return $sql->fetchAll();

    }
    public static function borrarFacturaModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE numFac = :numFac");
        $sql->bindParam(':numFac', $datosModel);
        if ($sql->execute()) {
            return 'success';
        }

    }

    public static function ventasDiariasModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ta
            JOIN clientes cli on cli.idCliente = ta.idCliente
            JOIN productos pro on ta.idProducto = pro.idProducto

          WHERE fechaVenta = :fechaVenta");
        $sql->bindParam(':fechaVenta', $datosModel);
        $sql->execute();

        return $sql->fetchAll();

    }

    public static function ventasUsuarioModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ta
            JOIN clientes cli on cli.idCliente = :idCliente
            JOIN productos pro on ta.idProducto = pro.idProducto
          WHERE fechaVenta = :fechaVenta");


        $sql->bindParam(':idCliente', $datosModel['idCliente']);
        $sql->bindParam(':fechaVenta', $datosModel['fecha']);
        $sql->execute();

        return $sql->fetchAll();

    }

}