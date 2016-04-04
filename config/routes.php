<?php
use Cake\Routing\Router;

Router::plugin(
    'CakePostman',
    ['path' => '/postman'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
