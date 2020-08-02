<?php

include_once "../productos/productosModel.php";
include_once "../conexion.php";

final class ProductosModelTest extends PHPUnit\Framework\TestCase
{


    /**
     * @dataProvider CasosdeRegistrarProductos
     */
    public function testRegistroProductoModel($datos){
        $this->expectOutputString('success');
        echo ProductosModel::registroProductoModel($datos,"productos");

    }



    public function CasosdeRegistrarProductos() {
        return [
            [["nombreProducto"=>"carnes",
                "idProveedor"=>123,
                "precioProducto"=>23000,
                "idCategoria"=>02]],


            [["nombreProducto"=>"caerrs",
                "idProveedor"=>1232,
                "precioProducto"=>22330,
                "idCategoria"=>NULL]]];
    }
}
