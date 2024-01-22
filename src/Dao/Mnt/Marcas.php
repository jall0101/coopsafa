<?php
namespace Dao\Mnt;
use Dao\Table;
class Marcas extends Table{

    //CONSULTA PARA INSERTAR EN TABLA DE MARCAS
    public static function insert(string $nombremarca): int
    {
        $sqlstr = "INSERT INTO marcas (nombremarca) values(:nombremarca);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("nombremarca"=>$nombremarca)
        );
        return $rowsInserted;
    }

    //CONSULTA PARA ACTUALIZAR EN TABLA DE MARCAS
    public static function update(
        string $nombremarca,
        int $marcacod
        
    ){
        $sqlstr = "UPDATE marcas set nombremarca = :nombremarca where marcacod=:marcacod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "nombremarca" => $nombremarca,
                "marcacod" => $marcacod
                
            )
        );
        return $rowsUpdated;
    }


    //CONSULTA PARA BORRAR EN TABLA DE MARCAS
    public static function delete(int $marcacod){
        $sqlstr = "DELETE from marcas where marcacod = :marcacod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "marcacod" => $marcacod
            )
        );
        return $rowsDeleted;
    }


    //CONSULTA PARA BUSCAR TODO EN TABLA DE MARCAS
    public static function findAll(){
        $sqlstr = "SELECT * from marcas;";
        return self::obtenerRegistros($sqlstr, array());
    }


    //CONSULTA PARA BUSCAR POR ID EN TABLA DE MARCAS
    public static function findById(int $marcacod){
        $sqlstr = "SELECT * from marcas where marcacod = :marcacod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "marcacod"=> $marcacod
            )
        );
        return $row;
    }
}
