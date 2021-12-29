<?php

namespace App\controllers;

use App\model\test;

class TestController
{

    public static function index()
    {
        responseJSON(200, true, 'Metodo GET', request());

    }


    public static function indexv2()
    {
        responseJSON(200, true, 'Hola desde la version 2');
    }


    public static function store()
    {

        responseJSON(200, true, 'Metodo POST', request());
        exit;

        $data = request();
        $insertados = 0;
        $noInsertados = 0;
        $actualizados = 0;


        $contenidoJSON = readFileTypeJSON($data['__FILE']['file']['tmp_name']);
        if (!$contenidoJSON->ok) {
            responseJSON(500, false, $contenidoJSON->msg);
        }


        $store = "EXEC SP_STORE_TEST :nombre, :correo";
        foreach ($contenidoJSON->data as $key) {

            $dataSTORE[':nombre'] = $key['name'] ?? '';
            $dataSTORE[':correo'] = $key['email'] ?? '';
            $response = test::getSP($store, $dataSTORE, 'one');

            if ($response['STATUSCODE'] == '200') {
                $actualizados++;
            } else if ($response['STATUSCODE'] == '201') {

                $insertados++;
            } else {
                $noInsertados++;
            }
        }


        responseJSON(200, true, '', [], [
            'insertados' => $insertados,
            'actulizados' => $actualizados,
            'no_insertados' => $noInsertados
        ]);
    }

    public static function update()
    {
        responseJSON(200, true, 'Metodo PUT', request());
    }

    public static function delete()
    {
        responseJSON(200, true, 'Metodo DELETE', request());
    }
}
