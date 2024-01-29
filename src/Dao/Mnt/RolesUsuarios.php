<?php


namespace Dao\Mnt;
use Dao\Table;
class RolesUsuarios extends Table{
    public static function insert(int $usercod ,string $rolescod ,string $roleuserest, string $roleuserexp): int
    {
        $date = new \DateTime("now");
        $roleuserfch = $date->format(\DateTimeInterface::W3C);
        $sqlstr = "INSERT INTO `roles_usuarios`
        (`usercod`,
        `rolescod`,
        `roleuserest`,
        `roleuserfch`,
        `roleuserexp`)
        VALUES
        (:usercod,
        :rolescod,
        :roleuserest,
        :roleuserfch,
        :roleuserexp);
        ";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("usercod" => $usercod, "roleuserfch" => $roleuserfch,"rolescod"=>$rolescod, "roleuserexp"=>$roleuserexp, "roleuserest"=>$roleuserest)
        );
        return $rowsInserted;
    }




    public static function update(int $usercod ,string $rolescod ,string $roleuserest, string $roleuserexp){
        $sqlstr = "UPDATE `roles_usuarios`
        SET
        `usercod` = :usercod,
        `rolescod` = :rolescod,
        `roleuserest` = :roleuserest
        `roleuserexp` = :roleuserexp
        WHERE `usercod` = :usercod AND `rolescod` = :rolescod;
        ";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array("usercod" => $usercod, "rolescod"=>$rolescod, "roleuserexp"=>$roleuserexp, "roleuserest"=>$roleuserest)

        );
        return $rowsUpdated;
    }




    public static function delete(int $usercod,  string $rolescod){
        $sqlstr = "DELETE from roles_usuarios where `usercod` = :usercod AND `rolescod` = :rolescod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "rolescod" => $rolescod,
                "usercod" => $usercod
            )
        );
        return $rowsDeleted;
    }



    public static function findAll(){
        $sqlstr = "SELECT * from roles_usuarios;";
        return self::obtenerRegistros($sqlstr, array());
    }




    public static function findById(int $usercod, string $rolescod){
        $sqlstr = "SELECT * from roles_usuarios where `usercod` = :usercod AND `rolescod` = :rolescod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "rolescod"=> $rolescod,
                "usercod" => $usercod
            )
        );
        return $row;
    }
}