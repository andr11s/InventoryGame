<?php

include_once "../ventas/ventasModel.php";
include_once "../conexion.php";


final class VentasModelTest extends  PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider CasosdeRegistrarFactura
     */
    public function testRegistroFacturaModel($datos){
        $this->expectOutputString('success');
        echo ventasModel::registroFacturaModel($datos,"temp");
    }





    /**
     * @dataProvider CasosdeRegistrarDetalles
     */

 /* public function testRegistrarVentasDetallesModel($datos)
   {
       $this->expectOutputString('success');
       echo ventasModel::registrarVentasDetallesModel("detalles",1,6);


  }*/

    public function CasosdeRegistrarFactura() {
        return [
            [["idProducto"=>123,"idCliente"=>106585,"precioVenta"=>27000,
                "cantidad"=>3,"iva"=>10,"totalVenta"=>60000,"numFac"=>11,
                "fechaVenta"=>"2019-01-12","unidad"=>23,"tipoFactura"=>"A"]],






            [["idProducto"=>NULL,"idCliente"=>NULL,"precioVenta"=>12222,
                "cantidad"=>2,"iva"=>2,"totalVenta"=>20000,"numFac"=>3,
                "fechaVenta"=>"2019-01-12","unidad"=>23,"tipoFactura"=>"A"]]
        ];
    }



    /*public function CasosdeRegistrarDetalles() {
        return [
            [["idCliente"=>14,"idProducto"=>22,"fechaVenta"=>"2019-09-08","precioVenta"=>1200,"cantidadKilos"=>12,"totalVenta"=>1000,"numFac"=>6,
                "tipoFactura"=>"A"]]


        ];
    }*/



}
