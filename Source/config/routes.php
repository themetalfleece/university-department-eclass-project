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

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Utility\Inflector;

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
    // enable the json extension for all the routes

    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    $routes->connect('/course/:code', ['controller' => 'Courses', 'action' => 'view'], ['pass' => ['code']]);

    $routes->connect('/users/:action', ['controller' => 'Users']);
    $routes->connect('/courses/:action', ['controller' => 'Courses']);
    $routes->connect('/announcements/:action/*', ['controller' => 'CourseAnnouncements']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    // have to explicitly report this before the user roles, because in order to be able to access /students/settings (otherwise it will look for user identifier 'settings')
    $routes->connect('/students/settings', ['controller' => 'Students', 'action' => 'settings']);
    $routes->connect('/professors/students', ['controller' => 'Professors', 'action' => 'students']);
    $routes->connect('/professors/index', ['controller' => 'Professors', 'action' => 'index']);
    $routes->connect('/professors/register', ['controller' => 'Professors', 'action' => 'register']);

    foreach (Configure::read('user.roles') as $role) {
        $controller = Inflector::pluralize(Inflector::camelize($role));
        $routes->connect('/' . $role, ['controller' => $controller, 'action' => 'home']);
        $routes->connect('/' . $role . '/:name', ['controller' => $controller, 'action' => 'home'], ['pass' => ['name']]);
        $routes->connect('/' . Inflector::pluralize($role) . '/:userIdentifier', ['controller' => $controller, 'action' => 'profile'], ['pass' => ['userIdentifier']]);
    }

    // enable json for ajax calls for any route connection that follows
    $routes->extensions(['json']);

    $routes->connect('/users/confirm-user', ['controller' => 'Users', 'action' => 'confirmUser']);
    $routes->connect('/user-phones/delete', ['controller' => 'UserPhones', 'action' => 'delete']);
    $routes->connect('/user-emails/delete', ['controller' => 'UserEmails', 'action' => 'delete']);
    $routes->connect('/professors/specific-student-courses', ['controller' => 'Professors', 'action' => 'studentCourses']);
    $routes->connect('/course-semester-reviews/get_reviews', ['controller' => 'CourseSemesterReviews', 'action' => 'getReviews']);
    $routes->connect('/professors/register', ['controller' => 'Professors', 'action' => 'register']);

    foreach (['Courses', 'Users', 'CoursesStudents'] as $resource) {
        $routes->resources($resource, [
            'inflect' => 'dasherize'
        ]);
    }

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
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
