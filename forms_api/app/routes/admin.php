<?php

    /**
     * Admin Routes
     */


     
    /**
     * Authentication Interface Routes
     */
    $router->respond('GET', '/login', function ($request, $response, $service) {
        require path::bootstrap('admin');
        $service->layout(path::component('auth', 'layouts/login.php'));
        if (auth::loggedIn()) {
            redirect::relative('/admin');
        } else {
            return $service->render(path::component('auth', 'views/login.php'));
        }
    });



    /*
    form CRUD
    */
    $router->respond(function ($request, $response, $service) {
        $service->layout(path::app('layouts/admin.php'));
    });


    // index
    $router->respond('GET', '/admin', function (...$args) {
        require path::bootstrap('admin');
        auth::protect();
        require path::component('admin', 'controllers/formController.php');
        return formController::index(...$args);
    });

    // create
    $router->respond('POST', '/admin/form', function ($request) {
        require path::bootstrap('admin');
        auth::protect(false);
        require path::app('controllers/formsController.php');
        require path::component('admin', 'controllers/formController.php');
        return formController::create($request);
    });
    
    // read, update, delete
    $router->respond('/admin/form/[:public_id]', function ($request, $response, $serivce) {
        require path::bootstrap('admin');
        auth::protect();
        require path::component('admin', 'controllers/formController.php');

        // determine method
        if (isset($_POST['_method'])) {
            $method = $_POST['_method'];
            unset($_POST['_method']);
        } else {
            $method = $request->method();
        }

        // methods
        if ($method == 'GET') {
            return formController::read($request, $response, $serivce);
        } elseif ($method == 'PUT') {
            return formController::update($request);
        } elseif($method == 'DELETE') {
            return formController::delete($request);
        }
    
    });