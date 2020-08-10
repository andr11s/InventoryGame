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
            [["nombreProducto"=>"fall guys", "idProveedor"=>19, "precioProducto"=>231000, "idCategoria"=>14]],

            [["nombreProducto"=>"-1", "idProveedor"=>12322, "precioProducto"=>23511, "idCategoria"=>NULL]]];
    }
}
