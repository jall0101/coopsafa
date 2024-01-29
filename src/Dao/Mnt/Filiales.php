<?php

//FILIALES
namespace Dao\Mnt;
use Dao\Table;
class Filiales extends Table{

    //INSERT EN TABLA DE FILIALES
    public static function insert(string $nombreFilial): int
    {
        $sqlstr = "INSERT INTO filiales (nombreFilial) values(:nombreFilial);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("nombreFilial"=>$nombreFilial)
        );
        return $rowsInserted;
    }


    //UPDATE EN TABLA DE FILIALES
    public static function update(
        string $nombreFilial,
        int $filialcod
    ){
        $sqlstr = "UPDATE filiales set nombreFilial = :nombreFilial where filialcod=:filialcod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "nombreFilial" => $nombreFilial,
                "filialcod" => $filialcod
            )
        );
        return $rowsUpdated;
    }


    //DELETE EN TABLA FILIALES
    public static function delete(int $filialcod){
        $sqlstr = "DELETE from filiales where filialcod=:filialcod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "filialcod" => $filialcod
            )
        );
        return $rowsDeleted;
    }

    

    public static function findAll(){
        $sqlstr = "SELECT * from filiales;";
        return self::obtenerRegistros($sqlstr, array());
    }




    public static function findById(int $filialcod){
        $sqlstr = "SELECT * from filiales where filialcod = :filialcod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "filialcod"=> $filialcod
            )
        );
        return $row;
    }
}
