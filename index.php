<?php

use App\controllers\TestController;
use App\lib\ActiveRecord;
use App\lib\DataBase;
use App\lib\Router;

require 'includes/app.php';

$cnx = DataBase::ConnectingDB();
ActiveRecord::setDB($cnx);


$router = new Router();

$router->get('/item', [TestController::class, 'index']);
$router->post('/item', [TestController::class, 'store']);
$router->put('/item', [TestController::class, 'update']);
$router->delete('/item', [TestController::class, 'delete']);







$router->run();
// $router->runBeta();
