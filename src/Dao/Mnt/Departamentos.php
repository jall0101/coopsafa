<?php

namespace Dao\Mnt;
use Dao\Table;
class Departamentos extends Table{

    public static function insert(string $nombredepartamento): int
    {
        $sqlstr = "INSERT INTO departamentos (nombredepartamento) values(:nombredepartamento);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("nombredepartamento"=>$nombredepartamento)
        );
        return $rowsInserted;
    }


    //ACTUALIZAR
    public static function update(
        string $nombredepartamento,
        int $departamentocod
    ){
        $sqlstr = "UPDATE departamentos set nombredepartamento = :nombredepartamento where departamentocod=:departamentocod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "nombredepartamento" => $nombredepartamento,
                "departamentocod" => $departamentocod
            )
        );
        return $rowsUpdated;
    }

    
    public static function delete(int $departamentocod){
        $sqlstr = "DELETE from departamentos where departamentocod=:departamentocod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "departamentocod" => $departamentocod
            )
        );
        return $rowsDeleted;
    }


    
    public static function findAll(){
        $sqlstr = "SELECT * from departamentos;";
        return self::obtenerRegistros($sqlstr, array());
    }
    public static function findByFilter(){
    }


    
    public static function findById(int $departamentocod){
        $sqlstr = "SELECT * from departamentos where departamentocod = :departamentocod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "departamentocod"=> $departamentocod
            )
        );
        return $row;
    }
}
