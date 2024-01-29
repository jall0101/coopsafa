<?php

namespace Dao\Mnt;
use Dao\Table;

class Inventarios extends Table{
    //FUNCIÓN PARA INGRESAR EQUIPOS AL IVENTARIO
    public static function insert(
            string $inventarioest="ACT",
            string $numInventario,
            string $nomEquipo,
            string $categoriaEquipo,
            string $descripcionEquipo,
            string $filialEquipo): int
    {
        $sqlstr = "INSERT INTO inventarios (
            inventarioest,
            numInventario,
            nomEquipo,
            categoriaEquipo,
            descripcionEquipo,
            filialEquipo)
            values(
            :inventarioest,
            :numInventario,
            :nomEquipo,
            :categoriaEquipo,
            :descripcionEquipo,
            :filialEquipo);";

        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array( "inventarioest"=>$inventarioest,
            "numInventario"=>$numInventario,
            "nomEquipo"=>$nomEquipo,
            "categoriaEquipo"=>$categoriaEquipo,
            "descripcionEquipo"=>$descripcionEquipo,
            "filialEquipo"=>$filialEquipo)
        );
        return $rowsInserted;
    }




    //FUNCION PARA ACTUALIZAR DATOS DEL INVENTARIO
    public static function update(
                int $id,
                string $inventarioest = "ACT",
                string $numInventario,
                string $nomEquipo,
                string $categoriaEquipo,
                string $descripcionEquipo,
                string $filialEquipo
        ){
        $sqlstr = "UPDATE inventarios set
                    inventarioest = :inventarioest,
                    numInventario = :numInventario,
                    nomEquipo = :nomEquipo,
                    categoriaEquipo = :categoriaEquipo,
                    descripcionEquipo = :descripcionEquipo,
                    filialEquipo = :filialEquipo where id=:id;";

        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array("id" => $id,
                "inventarioest"=>$inventarioest,
                "numInventario"=>$numInventario,
                "nomEquipo"=>$nomEquipo,
                "categoriaEquipo"=>$categoriaEquipo,
                "descripcionEquipo"=>$descripcionEquipo,
                "filialEquipo"=>$filialEquipo)
        );
        return $rowsUpdated;
    }




    //FUNCION PARA ELIMINAR DATOS DEL INVENTARIO
    public static function delete(int $id){
        $sqlstr = "DELETE from inventarios where id=:id;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "id" => $id
            )
        );
        return $rowsDeleted;
    }




    public static function findAll(){
        $sqlstr = "SELECT * from inventarios;";
        return self::obtenerRegistros($sqlstr, array());
    }



    public static function findByInventario(string $numInventario ){
        $sqlstr = "SELECT * FROM inventarios WHERE numInventario = :numInventario;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "numInventario" => $numInventario
            )
        );
        return $row;
    }


    
    public static function findByInvCate(string $numInventario, string $categoriaEquipo ){
        $sqlstr = "SELECT * FROM inventarios WHERE numInventario = :numInventario and categoriaEquipo = :categoriaEquipo";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(                
                "numInventario" => $numInventario,
                "categoriaEquipo" => $categoriaEquipo
            )
        );
        return $row;
    }


    public static function findByName(string $numInventario, string $nomEquipo){
        $sqlstr = "SELECT * FROM inventarios where numInventario like '%".$numInventario."%' and nomEquipo = :nonEquipo;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(                
                "nomEquipo" => $nomEquipo                
            )
        );
        return $row;
    }



    public static function findById(int $id){
        $sqlstr = "SELECT * from inventarios where id = :id;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "id"=> $id
            )
        );
        return $row;
    }

}