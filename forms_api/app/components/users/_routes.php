<?php

    /*
    user manager routes
    */
    

    // layout
    $router->respond(function ($request, $response, $service) {
        $service->layout(path::app('view/layouts/admin.php'));
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

    // read, update, delete
    $router->respond('/user/[:user_id]', function ($request, $response, $service) {
        require path::bootstrap('admin');
        auth::protect();
        require path::component('users', 'controllers/userController.php');

        // determine method
        if (isset($_POST['_method'])) {
            $method = $_POST['_method'];
            unset($_POST['_method']);
        } else {
            $method = $request->method();
        }

        // methods
        if ($method == 'GET') {
            return userController::read($request, $response, $service);
        } elseif ($method == 'PUT') {
            return userController::update($request);
        } elseif($method == 'DELETE') {
            return userController::delete($request);
        }
    
    });