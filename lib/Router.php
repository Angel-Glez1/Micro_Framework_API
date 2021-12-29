<?php

namespace App\lib;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];
    public $rutasPUT = [];
    public $rutasDELETE = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function put($url, $fn)
    {
        $this->rutasPUT[$url] = $fn;
    }

    public function delete($url, $fn)
    {
        $this->rutasDELETE[$url] = $fn;
    }



    public function run()
    {

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {

            $fn = $this->rutasGET[$urlActual] ?? null;
            
        } else if ($method === 'POST') {

            $data = count($_POST) > 0
                ? $_POST
                : json_decode(file_get_contents("php://input"), true);

            if (isset($data['method'])) {

                switch ($data['method']) {

                    case 'PUT':
                        $fn = $this->rutasPUT[$urlActual] ?? null;
                        break;

                    case 'DELETE':
                        $fn = $this->rutasDELETE[$urlActual] ?? null;
                        break;

                    default:
                        $fn = null;
                        break;
                }
            } else {

                $fn = $this->rutasPOST[$urlActual] ?? null;
            }
        } else {
            $fn = null;
        }



        if ($fn) {

            call_user_func($fn, $this);
        } else {

            responseJSON(400, false, "404 | Page not Found");
        }
    }


    public function runBeta()
    {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {

            $fn = $this->rutasGET[$urlActual] ?? null;
            
        } else if ($method === 'POST') {

            $fn = $this->rutasPOST[$urlActual] ?? null;

        }else if ($method === 'PUT') {

            $fn = $this->rutasPUT[$urlActual] ?? null;

        }else if ($method === 'DELETE') {

            $fn = $this->rutasDELETE[$urlActual] ?? null;

        } else  {
            $fn = null;
        }



        if ($fn) {

            call_user_func($fn, $this);
        } else {

            responseJSON(400, false, "404 | Page not Found");
        }
    }
}
