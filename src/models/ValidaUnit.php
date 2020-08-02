<?php


class ValidaUnit
{
    public static function ValidarEnterosRango1($datos){
        $flag = true;
        if(strlen($datos)<0 or strlen($datos)>=11 or is_string($datos)){
            echo json_encode(strlen($datos));
            $flag = false;
        }
        return $flag;
    }

    public static function ValidarCaracteres($datos){
        $flag = true;

        if(strlen($datos)<3 or strlen($datos)>=20 or is_numeric($datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }


    public static function ValidarEnteros($datos){
        $flag = true;
        if(strlen($datos)<0 or strlen($datos)>=11 or is_string($datos)){
            echo json_encode(strlen($datos));
            $flag = false;
        }
        return $flag;
    }

    public static function ValidarCaracteresAlfanume($datos){
        $flag = true;
        if(preg_match("/^[aA-zZ][15,30]$/",$datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }




    public static function ValidarCaracteresragnoDir($datos){
        $flag = true;

        if(strlen($datos)<15 and strlen($datos)>30 or ctype_alnum($datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }

    public static function ValidarEnterosRango($datos){
        $flag = true;

        if(strlen($datos)<7 or strlen($datos)>10 or is_string($datos)){
            echo json_encode($datos);
            $flag = false;
        }
        return $flag;
    }


    public static function ValidarPositivoRngo($datos){
        $flag = true;
        if(!is_numeric($datos) or $datos<1 or strlen($datos)>11){
            echo json_encode($datos);
            $flag = false;
        }

        return $flag;
    }

}