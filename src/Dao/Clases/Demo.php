<?php

namespace Dao\Clases;

use Dao\Table;

class Demo extends Table {
    public static function getAResponse() {
        return self::obtenerUnRegistro('select 1 as Response;', array());
    }
}


?>
