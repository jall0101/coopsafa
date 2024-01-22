<?php
namespace Dao\Mnt;
use Dao\Table;
class Asignados extends Table{


    //INSERTAR
    public static function insert(string $nombreDepartamento, string $nombreAsignado): int
    {
        $sqlstr = "INSERT INTO asignados (nombreDepartamento, nombreAsignado) values(:nombreDepartamento, :nombreAsignado);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "nombreDepartamento"=>$nombreDepartamento, 
                "nombreAsignado"=>$nombreAsignado)
        );
        return $rowsInserted;
    }


    //ACTUALIZAR
    public static function update(
        string $nombreDepartamento,
        string $nombreAsignado,
        int $asignadocod
    ){
        $sqlstr = "UPDATE asignados set nombreDepartamento = :nombreDepartamento, 
                        nombreAsignado = :nombreAsignado 
                        where asignadocod=:asignadocod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "nombreDepartamento" => $nombreDepartamento,
                "nombreAsignado" => $nombreAsignado,
                "asignadocod" => $asignadocod
            )
        );
        return $rowsUpdated;
    }


    //ELIMINAR
    public static function delete(int $asignadocod){
        $sqlstr = "DELETE from asignados where asignadocod=:asignadocod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "asignadocod" => $asignadocod
            )
        );
        return $rowsDeleted;
    }

    //BUSCAR TODO
    public static function findAll(){
        $sqlstr = "SELECT * from asignados;";
        return self::obtenerRegistros($sqlstr, array());
    }



    //BUSCAR POR ID
    public static function findById(int $asignadocod){
        $sqlstr = "SELECT * from asignados where asignadocod = :asignadocod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "asignadocod"=> $asignadocod
            )
        );
        return $row;
    }
}
