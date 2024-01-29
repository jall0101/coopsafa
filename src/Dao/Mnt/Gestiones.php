<?php
namespace Dao\Mnt;
use Dao\Table;
class Gestiones extends Table{

    //INSERT EN TABLA DE GESTIONES
    public static function insert(string $tipogestion, 
            string $invEquipoGestion, 
            string $nomEquipoGestion, 
            string $categoriaGestion, 
            string $descripcionGestion, 
            string $filialGestion, 
            string $departamentoGestion, 
            string $asignadoGestion): int
    {
        $sqlstr = "INSERT INTO gestiones (tipogestion, 
            invEquipoGestion, 
            nomEquipoGestion, 
            categoriaGestion,
            descripcionGestion, 
            filialGestion, 
            departamentoGestion, 
            asignadoGestion) 
            values(:tipogestion, 
            :invEquipoGestion,
            :nomEquipoGestion, 
            :categoriaGestion, 
            :descripcionGestion, 
            :filialGestion, 
            :departamentoGestion, 
            :asignadoGestion);";
        
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("tipogestion"=> $tipogestion, 
            "invEquipoGestion"=>$invEquipoGestion, 
            "nomEquipoGestion"=>$nomEquipoGestion, 
            "categoriaGestion"=>$categoriaGestion, 
            "descripcionGestion" => $descripcionGestion,
            "filialGestion"=>$filialGestion, 
            "departamentoGestion" => $departamentoGestion, 
            "asignadoGestion"=>$asignadoGestion)
        );
        return $rowsInserted;
    }


    //UPDATE EN TABLA DE FILIALES
    public static function update(
        int $gestioncod,
        string $tipogestion, 
        string $invEquipoGestion,
        string $nomEquipoGestion, 
        string $categoriaGestion, 
        string $descripcionGestion,
        string $filialGestion,
        string $departamentoGestion,
        string $asignadoGestion
    ){
        $sqlstr = "UPDATE gestiones set 
                tipogestion = :tipogestion, 
                invEquipoGestion = :invEquipoGestion, 
                nomEquipoGestion = :nomEquipoGestion, 
                categoriaGestion = :categoriaGestion, 
                descripcionGestion = :descripcionGestion,
                filialGestion = :filialGestion, 
                departamentoGestion = :departamentoGestion, 
                asignadoGestion = :asignadoGestion
                where gestioncod =:gestioncod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "gestioncod" => $gestioncod,
                "tipogestion"=>$tipogestion, 
                "invEquipoGestion"=>$invEquipoGestion, 
                "nomEquipoGestion"=>$nomEquipoGestion, 
                "categoriaGestion"=>$categoriaGestion, 
                "descripcionGestion"=>$descripcionGestion,
                "filialGestion"=>$filialGestion,
                "departamentoGestion" => $departamentoGestion, 
                "asignadoGestion" => $asignadoGestion)
        );
        return $rowsUpdated;
    }


     //FUNCION PARA ELIMINAR EN LA TABLA DE gestiones
     public static function delete(int $gestioncod){
        $sqlstr = "DELETE from gestiones where gestioncod=:gestioncod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "gestioncod" => $gestioncod
            )
        );
        return $rowsDeleted;
    }



    //FUNCIONES PARA BUSQUEDAS
    //BUSCAR TODO
    public static function findAll(){
        $sqlstr = "SELECT * from gestiones;";
        return self::obtenerRegistros($sqlstr, array());
    }


    //BUSCAR POR GESTION
    public static function findByGestion(string $tipogestion){
        $sqlstr = "SELECT * FROM gestiones WHERE tipogestion = :tipogestion;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "tipogestion" => $tipogestion
            )
        );
        return $row;
    }



    //BUSCAR POR FILIAL
    public static function findByFilial(string $filialGestion){
        $sqlstr = "SELECT * FROM gestiones WHERE filialGestion = :filialGestion;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "filialGestion" => $filialGestion
            )
        );
        return $row;
    }

    //BUSCAR POR INVENTARIO
    public static function findByInventario(string $invEquipoGestion){
        $sqlstr = "SELECT * FROM gestiones WHERE invEquipoGestion = :invEquipoGestion;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "invEquipoGestion" => $invEquipoGestion
            )
        );
        return $row;
    }

     //BUSCAR POR asignado
     public static function findByAsignado(string $asignadoGestion){
        $sqlstr = "SELECT * FROM gestiones WHERE asignadoGestion = :asignadoGestion;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "asignadoGestion" => $asignadoGestion
            )
        );
        return $row;
    }

    //BUSQUEDA POR ID DE INGRESO
    public static function findById(int $gestioncod){
        $sqlstr = "SELECT * from gestiones where gestioncod = :gestioncod ;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "gestioncod"=> $gestioncod
            )
        );
        return $row;
    }


}
