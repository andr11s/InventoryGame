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
            [["nombreCliente"=>"Jose alvarez","apellidoCliente"=>"ncavarro","idProvincia"=>70,"usuarioCliente"=>"joser331234",
                "passwordCliente"=>"joAse002","telefono"=>3112345547,"emailCliente"=>"jose@gmail.com", "direccion"=>"calle 23 18-31",
                "idCiudad"=>1,"cuit"=>1234]],

            [["nombreCliente"=>NULL,"apellidoCliente"=>"pacer", "idProvincia"=>70,"usuarioCliente"=>"dawda","passwordCliente"=>"acaa2",
                "telefono"=>2123454345,"emailCliente"=>"karen@gmail.com","direccion"=>"pcoridd ", "idCiudad"=>1,"cuit"=>1234]]
        ];
    }

}
