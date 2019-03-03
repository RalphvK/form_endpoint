<?php

    /*
    account routes
    */
    

    // index/read, update
    $router->respond('/account', function ($request, $response, $serivce) {
        require path::bootstrap('admin');
        auth::protect();
        require path::component('account', 'controllers/accountController.php');

        // determine method
        if (isset($_POST['_method'])) {
            $method = $_POST['_method'];
            unset($_POST['_method']);
        } else {
            $method = $request->method();
        }

        // methods
        if ($method == 'GET') {
            return accountController::read($request, $response, $serivce);
        } elseif ($method == 'PUT') {
            return accountController::update($request);
        }
    });