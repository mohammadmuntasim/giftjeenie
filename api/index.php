<?php
require './vendor/autoload.php';
require './includes/database.php';
require './includes/functions.user.php';
require './includes/functions.products.php';
require './includes/functions.gift.php';
require './includes/functions.wishlist.php';
require './includes/functions.message.php';
require './includes/functions.deals.php';
require './includes/functions.trends.php';
require './includes/functions.friends.php';
require './classes/auth.class.php';

// Register service provider with the container
$container = new \Slim\Container;
$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};
$container['settings'] = [
    'displayErrorDetails' => true,
    'outputBuffering' => false,
    'httpVersion' => '1.1',
    'responseChunkSize' => 4096,
    'determineRouteBeforeAppMiddleware' => true,
    'addContentLengthHeader' => false,
];

// Add Authentication Middleware
$auth = new Auth();
$container->register( $auth );

// Add middleware to the application
$app = new \Slim\App($container);
$app->add(new \Slim\HttpCache\Cache('public', 86400));

$app->get('/', function ($request, $response) {
    return $response->getBody()->write('Hello World v4');
});

$routeFiles = (array) glob('routes/*.php');

foreach( $routeFiles as $routeFile ) 
{
   require  $routeFile;
}

$app->run();