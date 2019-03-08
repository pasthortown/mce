<?php

namespace app\models;

use Yii;
use app\models\Utilities;

class Licenciatario_ApiRest {

    function __construct($arr_params = array()) {
        
    }

    public function getNumeroLicenciatarios() {
        $con = Yii::$app->db;
        $trans = $con->getTransaction();
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction();
        }
        $sql = "SELECT 
                    count(*) AS size
                FROM 
                    mce_registro AS r 
                    JOIN usuario AS u ON u.usu_id=r.usu_id 
                WHERE
                    r.usu_id = u.usu_id AND
                    r.reg_estado=1 AND
                    r.reg_estado_logico=1 AND
                    u.usu_estado_activo=1 AND
                    u.usu_estado_logico=1";
        $comando = $con->createCommand($sql);
        $size = $comando->queryOne();
        return array("status" => "OK", "size" => $size['size']);
    }

}
