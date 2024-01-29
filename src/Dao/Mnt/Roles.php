<?php


namespace Dao\Mnt;
use Dao\Table;
class Roles extends Table{
    public static function insert(string $rolescod ,string $rolesdsc, string $rolesest="ACT"): int
    {
        $sqlstr = "INSERT INTO roles (rolescod,rolesdsc,rolesest) values(:rolescod,:rolesdsc,:rolesest);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("rolescod"=>$rolescod, "rolesdsc"=>$rolesdsc, "rolesest"=>$rolesest)
        );
        return $rowsInserted;
    }



    public static function update(string $rolescod ,string $rolesdsc, string $rolesest){
        $sqlstr = "UPDATE roles set rolesdsc = :rolesdsc, rolesest = :rolesest where rolescod=:rolescod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "rolesdsc" => $rolesdsc,
                "rolesest" => $rolesest,
                "rolescod" => $rolescod
            )
        );
        return $rowsUpdated;
    }



    public static function delete(string $rolescod){
        $sqlstr = "DELETE from roles where rolescod=:rolescod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "rolescod" => $rolescod
            )
        );
        return $rowsDeleted;
    }



    public static function findAll(){
        $sqlstr = "SELECT * from roles;";
        return self::obtenerRegistros($sqlstr, array());
    }



    public static function findById(string $rolescod){
        $sqlstr = "SELECT * from roles where rolescod = :rolescod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "rolescod"=> $rolescod
            )
        );
        return $row;
    }
}