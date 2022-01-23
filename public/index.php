<?php
require_once '../bootstrap.php';
session_start();
$prefix = "App\\Controller\\";

$match = $router ->match();

if($match === false){
    die("ruta no encontrada");
}

if (is_array($match)) {
    $target = explode("#", $match["target"]);
    $controller = $prefix . $target[0];
    $method = $target[1];
    if (method_exists($controller, $method)) {
        $object = new $controller;
        $response = call_user_func_array([$object, $method], $match['params']);

        if($response != null){
            $response->writeHeaders();
            echo $response->render();
        }
    } else {
        // no route was matched
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo "method not exists";
    }
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "error";
}