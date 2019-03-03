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
    routeLoader::component('auth');
    routeLoader::component('admin');
    routeLoader::component('account');
    // load remaining components
    routeLoader::allComponents();

    $router->dispatch();