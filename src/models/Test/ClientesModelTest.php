<?php

include_once "../clientes/clientesModel.php";
include_once "../conexion.php";

final class ClientesModelTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider CasosdeRegistrarClientes
     */
    public function testRegistrarClientesModel($datos)
    {
        $this->expectOutputString('success');
        echo  ClientesModel::registrarClientesModel($datos,"clientes");
    }


    public function CasosdeRegistrarClientes() {
        return [
            [["nombreCliente"=>"Lili",
                "apellidoCliente"=>"ortiz",
                "idProvincia"=>70,
                "usuarioCliente"=>"krenlior1234",
                "passwordCliente"=>"k123",
                "telefono"=>3147691847,
                "emailCliente"=>"alvis@gmail.com",
                "direccion"=>"mz 60 cs 6",
                "idCiudad"=>1,"cuit"=>1234]],




            [["nombreCliente"=>NULL,"apellidoCliente"=>"pacer",
                "idProvincia"=>70,
                "usuarioCliente"=>"dawda","passwordCliente"=>"acaa2",
                "telefono"=>2123454345,
                "emailCliente"=>"karen@gmail.com","direccion"=>"pcoridd ",
                "idCiudad"=>1,"cuit"=>1234]]


        ];
    }

}
