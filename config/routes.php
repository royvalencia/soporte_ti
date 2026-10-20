<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    //$routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/', ['controller' => 'Servicios', 'action' => 'index']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    //Correo Restablecer contraseña
    $routes->connect('/reset-password', ['controller' => 'CoUsers', 'action' => 'forgotPassword']);
    //Registras cuenta
    $routes->connect('/register', ['controller' => 'CoUsers', 'action' => 'register']);
    //Restablecer Contraseña con Token
    $routes->connect(
        '/restablecer-password/:token',
        ['controller' => 'CoUsers', 'action' => 'resetPassword'],
        ['pass' => ['token'], 'token' => '[a-zA-Z0-9\-]+']
    );

  /*  // Añadir rutas para login paso 1 y paso 2
    $routes->connect('/loginpaso1', ['controller' => 'CoUsers', 'action' => 'loginpaso1']);
    $routes->connect('/loginpaso2', ['controller' => 'CoUsers', 'action' => 'loginpaso2']);*/
    /**
 * //Agregamos la extension PDF para poder generar PDFs con
 * // https://github.com/FriendsOfCake/CakePdf
 */
     $routes->addExtensions(['pdf','json','xml','xls']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

/**
 * Rutas para el acceso a la API
 */
Router::prefix('api', function ($routes) {
    $routes->setExtensions(['json', 'xml']);
     $routes->resources('Mascotas', [
        'map' => [
            'index/:id' => [
                'action' => 'index',
                'method' => 'GET'
            ]
        ]
    ]);

      $routes->resources('Propietarios', [
        'map' => [
            'token' => [
                'action' => 'token',
                'method' => 'POST'
            ]
        ]
    ]);
    $routes->resources('CoUsers', [
        'map' => [
            'token' => [
                'action' => 'token',
                'method' => 'POST'
            ]
        ]
    ]);
     $routes->resources('Expedientes');
      //Enmascaramos el users porque en realidad en el back end son los propietarios y en front end son los usuarios
  Router::connect('/api/users/:action', array('controller'=>'CoUsers','prefix'=>'api'));
  //Router::connect('/api/users/register', ['controller' => 'Propietarios', 'action' => 'add', 'prefix' => 'api']);
     $routes->fallbacks('InflectedRoute');
});
/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
