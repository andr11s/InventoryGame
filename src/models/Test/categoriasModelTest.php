<?php


include_once "../categorias/categoriasModel.php";
include_once "../conexion.php";

Final class categoriasModelTest extends PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider CasosdeRegistrarCategorias
     */
    public function testAgregarCategoriasModel($datos)
    {
        $this->expectOutputString('success');
        echo categoriasModel::agregarCategoriasModel($datos,"categorias");
    }



    public function CasosdeRegistrarCategorias() {
        return [
            [["nombreCategoria"=>"carnes"]],
            [["nombreCategoria"=>NULL]]

        ];
    }
}
