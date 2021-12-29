<?php

namespace App\lib;

use PDO;
use PDOException;

class ActiveRecord
{


    protected static $db;



    public static function setDB($conexion)
    {

        self::$db = $conexion;
    }



    public static function execSP($store, $data = [])
    {

        try {

            $stmt = self::$db->prepare($store);
            $resultado = $stmt->execute($data);
            return $resultado;

        } catch (PDOException $e) {

            responseJSON(500, false, $e->getMessage());
        }
    }

    public static function getSP($store, $dataSP = [], $typeFECTH = 'all')
    {


        try {

            $stmt = self::$db->prepare($store);
            $stmt->execute($dataSP);


            if ($typeFECTH === 'all') {

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else if ($typeFECTH === 'one') {

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            return $resultado;
        } catch (PDOException $e) {

            responseJSON(500, false, $e->getMessage());
        }
    }
}
