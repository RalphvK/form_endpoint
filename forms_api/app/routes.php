<?php

    $router = new \Klein\Klein();

    include path::router('main');
    include path::router('auth');
    include path::router('admin');
    include path::router('account');

    $router->dispatch();