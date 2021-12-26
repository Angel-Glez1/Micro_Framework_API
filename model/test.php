<?php
namespace App\model;

use App\lib\ActiveRecord;
use PDO;

class test extends ActiveRecord {



    public static function all(){
        $stmt = self::$db->prepare("SELECT * FROM TB_Test_Framework_API order by id desc");
        $stmt->execute();
        $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cliente;
    }
}