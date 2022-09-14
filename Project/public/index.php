<?php

try {

    include __DIR__ . '/../includes/autoLoader.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    // $route = $_GET['route'] ?? 'joke/home';
    // $password = 'haggai';
    // $hash = password_hash($password, PASSWORD_DEFAULT);

    // echo $hash;



    $method = $_SERVER['REQUEST_METHOD'];

    // echo $method;


    $entryPoint = new \Ninja\EntryPoint($route, $method, new \Ijdb\IjdbRoutes());
    $entryPoint->run();
    


} catch (PDOException $e) {

$title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . '
in ' . $e->getFile() . ':' . $e->getLine();

include __DIR__ . '/../templates/layout.html.php';
}










