<?php
namespace Dao\Mnt;
use Dao\Table;

class Entradasalidas extends Table{
    //FUNCIONES PARA EL CRUD DE ENTRADAS Y SALIDAS
    //FUNCION PARA INSERTAR EN LA TABLA DE entradas_salidas
    public static function insert(
        string $gestionEoS,
        string $inventarioEquipoES,
        string $nomEquipo,
        string $categoria,
        string $descripcion,
        string $filial,
        string $departamento,
        string $asignado): int
    {
        $sqlstr = "INSERT INTO entradas_salidas (
            gestionEoS, 
            inventarioEquipoES, 
            nomEquipo, 
            categoria, 
            descripcion, 
            filial, 
            departamento, 
            asignado) 

            values(:gestionEoS, 
            :inventarioEquipoES, 
            :nomEquipo, 
            :categoria, 
            :descripcion, 
            :filial, 
            :departamento, 
            :asignado);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("gestionEoS"=> $gestionEoS,
            "inventarioEquipoES"=>$inventarioEquipoES, 
            "nomEquipo"=>$nomEquipo, 
            "categoria"=>$categoria, 
            "descripcion" => $descripcion,
            "filial"=>$filial, 
            "departamento" => $departamento, 
            "asignado"=>$asignado)
        );
        return $rowsInserted;
    }


    //FUNCION PARA ACTUALIZAR EN LA TABLA DE entradas_salidas
    public static function update(
                int $idEntradasalida,
                string $gestionEoS, 
                string $inventarioEquipoES,
                string $nomEquipo, 
                string $categoria, 
                string $descripcion,
                string $filial,
                string $departamento,
                string $asignado
                
        ){
        $sqlstr = "UPDATE entradas_salidas set
                    gestionEoS = :gestionEoS, 
                    inventarioEquipoES = :inventarioEquipoES, 
                    nomEquipo = :nomEquipo, 
                    categoria = :categoria, 
                    descripcion = :descripcion,
                    filial = :filial, 
                    departamento = :departamento, 
                    asignado = :asignado
                    where idEntradasalida =:idEntradasalida;";

        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "idEntradasalida" => $idEntradasalida,
                "gestionEoS"=>$gestionEoS, 
                "inventarioEquipoES"=>$inventarioEquipoES, 
                "nomEquipo"=>$nomEquipo, 
                "categoria"=>$categoria, 
                "descripcion"=>$descripcion,
                "filial"=>$filial,
                "departamento" => $departamento, 
                "asignado" => $asignado)
        );
        return $rowsUpdated;
    }


    //FUNCION PARA ELIMINAR EN LA TABLA DE entradas_salidas
    public static function delete(int $idEntradasalida){
        $sqlstr = "DELETE from entradas_salidas where idEntradasalida=:idEntradasalida;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "idEntradasalida" => $idEntradasalida
            )
        );
        return $rowsDeleted;
    }



    //FUNCIONES PARA BUSQUEDAS
    //BUSCAR TODO
    public static function findAll(){
        $sqlstr = "SELECT * from entradas_salidas;";
        return self::obtenerRegistros($sqlstr, array());
    }


    //BUSCAR POR GESTION
    public static function findByGestion(string $gestionEoS ){
        $sqlstr = "SELECT * FROM entradas_salidas WHERE gestionEoS = :gestionEoS;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "gestionEoS" => $gestionEoS
            )
        );
        return $row;
    }



    //BUSCAR POR FILIAL
    public static function findByFilial(string $filial ){
        $sqlstr = "SELECT * FROM entradas_salidas WHERE filial = :filial;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "filial" => $filial
            )
        );
        return $row;
    }

    //BUSCAR POR INVENTARIO
    public static function findByInventario(string $inventarioEquipoES ){
        $sqlstr = "SELECT * FROM entradas_salidas WHERE inventarioEquipoES = :inventarioEquipoES;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "inventarioEquipoES" => $inventarioEquipoES
            )
        );
        return $row;
    }

     //BUSCAR POR asignado
     public static function findByAsignado(string $asignado ){
        $sqlstr = "SELECT * FROM entradas_salidas WHERE asignado = :asignado;";
        $row = self::obtenerRegistros(
            $sqlstr,
            array(
                
                "asignado" => $asignado
            )
        );
        return $row;
    }

    //BUSQUEDA POR ID DE INGRESO
    public static function findById(int $idEntradasalida ){
        $sqlstr = "SELECT * from entradas_salidas where idEntradasalida  = :idEntradasalida ;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "idEntradasalida "=> $idEntradasalida 
            )
        );
        return $row;
    }
}