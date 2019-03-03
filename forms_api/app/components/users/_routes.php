<?php

    /*
    user manager routes
    */
    

    // layout
    $router->respond(function ($request, $response, $service) {
        $service->layout(path::app('layouts/admin.php'));
    });

    // index
    $router->respond('GET', '/users', function (...$args) {
        require path::bootstrap('admin');
        auth::protect();
        require path::component('users', 'controllers/userController.php');
        return userController::index(...$args);
    });

    // create
    $router->respond('POST', '/user', function ($request) {
        require path::bootstrap('admin');
        auth::protect();
        require path::component('users', 'controllers/userController.php');
        return userController::create($request);
    });