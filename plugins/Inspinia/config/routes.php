<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Inspinia',
    ['path' => '/inspinia'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
