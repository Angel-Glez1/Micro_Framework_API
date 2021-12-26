<?php

namespace App\lib;

use PDO;
use PDOException;

class DataBase
{

    public static function ConnectingDB()
    {

        $nameServer = $_ENV['DB_HOST'];
        $nameDB = $_ENV['DB_NAME'];
        $userDB = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];


        try {

            $conexion = new PDO("sqlsrv:Server=$nameServer;Database=$nameDB", $userDB, $password);
            $conexion->exec("set names utf8");
            return $conexion;

        } catch (PDOException $e) {

            echo json_encode($e->getMessage());
            die();
        }
    }
}
