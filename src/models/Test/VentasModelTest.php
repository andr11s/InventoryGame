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
    public function CasosdeRegistrarFactura() {
        return [
            [["idProducto"=>5,"idCliente"=>17,"precioVenta"=>273000, "cantidad"=>23,"iva"=>10,"totalVenta"=>60000,"numFac"=>11,
                "fechaVenta"=>"2020-08-08", "unidad"=>3,"tipoFactura"=>"A"]],

            [["idProducto"=>NULL,"idCliente"=>NULL,"precioVenta"=>NULL,"cantidad"=>2,"iva"=>2,"totalVenta"=>NULL,"numFac"=>3,
                "fechaVenta"=>"2019-01-12","unidad"=>NULL,"tipoFactura"=>"A"]]
        ];
    }
}
