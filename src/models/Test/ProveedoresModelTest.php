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
            [["nombreProveedor"=>"jariun","apellidoProveedor"=>"diaz","nombreEmpresa"=>"sony warnig",
                "telefonoProveedor"=>5434567,"direccionProveedor"=>"aavenida 9 calle 23","idCiudad"=>1]],

            [["nombreProveedor"=>null,"apellidoProveedor"=>null,"nombreEmpresa"=>null,
                "telefonoProveedor"=>NULL,"direccionProveedor"=>"carrera 23 calle","idCiudad"=>null]]
        ];
    }
}
