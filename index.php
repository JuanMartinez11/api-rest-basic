<?php

function function_prueba(){

    die(json_encode(array('saludo'=>'Hola, como vas')));
   
}


require_once 'route.php';
require_once 'request.php';
require_once 'response.php';
require_once 'api.php';

$apiRest = new IBApi();



$apiRest->registerRoute('/users/',['method'=>'get', 'format'=> 'JSON', 'callback'=>'function_prueba']);


$apiRest->request();
