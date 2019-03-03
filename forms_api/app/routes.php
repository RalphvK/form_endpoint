<?php

    $router = new \Klein\Klein();

    /*
    home
    */
    $router->respond('GET', '/', function ($request) {
        require path::bootstrap('admin');
        if (auth::loggedIn()) {
            redirect::relative('/admin');
        } else {
            redirect::relative('/login');
        }
    });

    /*
    form endpoint
    */
    $router->respond('POST', '/form/[:form_id]', function ($request) {
        require path::app('controllers/messageController.php');
        return messageController::post($request);
    });

    /*
    component routes
    */
    include path::component('auth', '_routes.php');
    include path::component('admin', '_routes.php');
    include path::component('account', '_routes.php');

    $router->dispatch();