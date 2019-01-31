<?php

    $router = new \Klein\Klein();

    /*
    home
    */
    $router->respond('GET', '/', function ($request) {
        require path::app('views/index.php');
    });

    /*
    pairing
    */
    $router->respond('POST', '/form/[:form_id]', function ($request) {
        require path::app('controllers/formController.php');
        return formController::post($request);
    });

    $router->dispatch();