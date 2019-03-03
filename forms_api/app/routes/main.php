<?php

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