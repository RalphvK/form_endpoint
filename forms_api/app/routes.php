<?php

    $router = new \Klein\Klein();

    /*
    home
    */
    $router->respond('GET', '/', function ($request) {
        require path::app('views/index.php');
    });

    /*
    form endpoint
    */
    $router->respond('POST', '/form/[:form_id]', function ($request) {
        require path::app('controllers/messageController.php');
        return messageController::post($request);
    });

    /**
     * Authentication API Routes
     */

    /*
    test authentication
    */
    $router->respond('/auth/test', function ($request) {
        require path::bootstrap('admin');
        auth::protect(false);
        return json_file([], 'success');
    });

    /*
    login
    */
    $router->respond('POST', '/auth/login', function ($request) {
        require path::bootstrap('admin');
        require path::component('auth', 'controllers/loginController.php');
        return loginController::login($request);
    });

    /*
    logout
    */
    $router->respond('POST', '/auth/logout', function ($request) {
        require path::bootstrap('admin');
        require path::component('auth', 'controllers/loginController.php');
        return loginController::logout($request);
    });

    /**
     * Admin Routes
     */

    /*
    form CRUD
    */
    // index
    $router->respond('GET', '/admin/forms', function ($request) {
        require path::bootstrap('admin');
        auth::protect(false);
        require path::component('admin', 'controllers/formController.php');
        return formController::index($request);
    });
    // create
    $router->respond('POST', '/admin/form', function ($request) {
        require path::bootstrap('admin');
        auth::protect(false);
        require path::component('admin', 'controllers/formController.php');
        return formController::create($request);
    });
    // read, update, delete
    $router->respond('/admin/form/[:public_id]', function ($request) {
        require path::bootstrap('admin');
        auth::protect(false);
        require path::component('admin', 'controllers/formController.php');
        
        if ($request->method('GET')) {
            return formController::read($request);
        } elseif ($request->method('PUT')) {
            return formController::update($request);
        } elseif($request->method('DELETE')) {
            return formController::delete($request);
        }
    });

    $router->dispatch();