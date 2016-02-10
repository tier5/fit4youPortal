<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

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
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/administrator', ['controller' => 'Users', 'action' => 'index']);
    $routes->connect('/administrator/dashboard', ['controller' => 'Users', 'action' => 'dashboard']);

    $routes->connect('/administrator/roles', ['controller' => 'Adminroles', 'action' => 'index']);
    $routes->connect('/administrator/roles/add', ['controller' => 'Adminroles', 'action' => 'add']);
    $routes->connect('/administrator/roles/edit/*', ['controller' => 'Adminroles', 'action' => 'edit']);
    $routes->connect('/administrator/roles/delete/*', ['controller' => 'Adminroles', 'action' => 'delete']);

    $routes->connect('/administrator/user/add', ['controller' => 'Users', 'action' => 'add']);
    $routes->connect('/administrator/client', ['controller' => 'Users', 'action' => 'userlist']);
    $routes->connect('/administrator/trainer', ['controller' => 'Users', 'action' => 'trainerlist']);
    $routes->connect('/administrator/user/edit/*', ['controller' => 'Users', 'action' => 'edit']);
    $routes->connect('/administrator/user/delete/*', ['controller' => 'Users', 'action' => 'delete']);
	$routes->connect('/administrator/user/userstat/*', ['controller' => 'Users', 'action' => 'userStat']);
    $routes->connect('/administrator/user/delete-stat/*', ['controller' => 'Users', 'action' => 'deleteStat']);
	$routes->connect('/administrator/user/user-profile', ['controller' => 'Users', 'action' => 'deleteStat']);
	
    
    $routes->connect('/administrator/gyms/add', ['controller' => 'Admingyms', 'action' => 'add']);
    $routes->connect('/administrator/gyms', ['controller' => 'Admingyms', 'action' => 'index']);
    $routes->connect('/administrator/gyms/edit/*', ['controller' => 'Admingyms', 'action' => 'edit']);
    $routes->connect('/administrator/gyms/delete/*', ['controller' => 'Admingyms', 'action' => 'delete']);
	
	$routes->connect('/administrator/schedule', ['controller' => 'Adminschedules', 'action' => 'index']);
	$routes->connect('/administrator/schedule/add', ['controller' => 'Adminschedules', 'action' => 'add']);
	$routes->connect('/administrator/schedule/edit/*', ['controller' => 'Adminschedules', 'action' => 'edit']);
	$routes->connect('/administrator/schedule/delete/*', ['controller' => 'Adminschedules', 'action' => 'delete']);

	$routes->connect('/administrator/settings', ['controller' => 'Adminsettings', 'action' => 'index']);
	$routes->connect('/administrator/settings/add', ['controller' => 'Adminsettings', 'action' => 'add']);
	$routes->connect('/administrator/settings/edit/*', ['controller' => 'Adminsettings', 'action' => 'edit']);
	$routes->connect('/administrator/settings/delete/*', ['controller' => 'Adminsettings', 'action' => 'delete']);
	
	// For Web Services Only
	    
    $routes->connect('/webservice/clientlogin', ['controller' => 'Webservices', 'action' => 'loginClient']);
    $routes->connect('/webservice/trainerlogin', ['controller' => 'Webservices', 'action' => 'loginTrainer']);
    $routes->connect('/webservice/adminlogin', ['controller' => 'Webservices', 'action' => 'adminLogin']);
    $routes->connect('/webservice/missed', ['controller' => 'Webservices', 'action' => 'missed']);
    $routes->connect('/webservice/present', ['controller' => 'Webservices', 'action' => 'present']);
	$routes->connect('/webservice/current-gym', ['controller' => 'Webservices', 'action' => 'currentGym']);

	
	// For Web Services Testing:
	$routes->connect('/webservice/clientlogintest', ['controller' => 'Webservices', 'action' => 'loginClientTest']);
	$routes->connect('/webservice/trainerlogintest', ['controller' => 'Webservices', 'action' => 'loginTrainerTest']);
	
	
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `InflectedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);`
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
    $routes->fallbacks('InflectedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
