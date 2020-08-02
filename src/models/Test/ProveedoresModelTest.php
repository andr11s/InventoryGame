<?php

include_once  "../proveedores/proveedoresModel.php";
include_once  "../conexion.php";


final class ProveedoresModelTest extends  PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider CasosdeRegistrarProveedores
     */
    public function testAgregarProveedorModel($datos)
    {
        $this->expectOutputString('success');
        echo ProveedoresModel::agregarProveedorModel($datos,"proveedores");
    }





    public function CasosdeRegistrarProveedores() {
        return [
            [["nombreProveedor"=>"pedro","apellidoProveedor"=>"perez","nombreEmpresa"=>"carnes del Cesar12",
                "telefonoProveedor"=>5812648,"direccionProveedor"=>"carrera 15 calle 13","idCiudad"=>1]],






            [["nombreProveedor"=>"afafaf","apellidoProveedor"=>"afafaf","nombreEmpresa"=>"cesar  1www",
                "telefonoProveedor"=>NULL,"direccionProveedor"=>"carrera 23 calle","idCiudad"=>"fafa"]]


        ];
    }
}
