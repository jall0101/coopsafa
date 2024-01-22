<?php
namespace Dao\Mnt;

use Dao\Table;
/*
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(45) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL,
*/

class Funciones extends Table{
    
    public static function insert(string $fncod ,string $fndsc, string $fnest="ACT", string $fntyp = "ADM"): int
    {
        $sqlstr = "INSERT INTO funciones (fncod,fndsc,fnest,fntyp) values(:fncod,:fndsc,:fnest,:fntyp);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "fncod"=>$fncod, 
                "fndsc"=>$fndsc, 
                "fnest"=>$fnest, 
                "fntyp" => $fntyp
            )
        );
        return $rowsInserted;
    }
    public static function update(string $fncod ,string $fndsc, string $fnest, string $fntyp){
        $sqlstr = "UPDATE funciones set fndsc = :fndsc, fnest = :fnest, fntyp = :fntyp where fncod=:fncod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "fndsc" => $fndsc,
                "fnest" => $fnest,
                "fntyp" => $fntyp,
                "fncod"  => $fncod
            )
        );
        return $rowsUpdated;
    }
    public static function delete(string $fncod){
        $sqlstr = "DELETE from funciones where fncod=:fncod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "fncod" => $fncod
            )
        );
        return $rowsDeleted;
    }
    public static function findAll(){
        $sqlstr = "SELECT * from funciones;";
        return self::obtenerRegistros($sqlstr, array());
    }
    public static function findByFilter(){

    }
    public static function findById(string $fncod){
        $sqlstr = "SELECT * from funciones where fncod = :fncod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "fncod"=> $fncod
            )
        );
        return $row;
    }
}