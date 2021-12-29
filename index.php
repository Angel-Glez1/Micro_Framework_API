<?php

use App\controllers\TestController;
use App\lib\ActiveRecord;
use App\lib\DataBase;
use App\lib\Router;

require 'includes/app.php';

// Conectar en base
$cnx = DataBase::ConnectingDB();
ActiveRecord::setDB($cnx);


$router = new Router();

$router->get('/v1/item/prestamos', [TestController::class, 'index']);
$router->get('/v2/item/prestamos', [TestController::class, 'indexv2']);
$router->post('/item', [TestController::class, 'store']);
$router->put('/item', [TestController::class, 'update']);
$router->delete('/item', [TestController::class, 'delete']);







// $router->run(); // No acepta metodos HTTP como PUT o DELETE
$router->runBeta(); // Acepta todos los metodos HTTP
