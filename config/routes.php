<?php

$router->map('GET', '/', function () {
    $parameters = [
        'controller' => 'index.php',
        'view' => 'index.html',
        'title' => 'Index',
        'flashes' => true,
        'restricted' => false,
        'header' => true,
        'footer' => true,
    ];
    echo superHandler($parameters);
});

$router->map('GET|POST', '/login', function () {
    $parameters = [
        'controller' => 'session/login.php',
        'view' => 'session/login.html',
        'title' => 'Login',
        'flashes' => true,
        'restricted' => false,
        'header' => true,
        'footer' => true,
    ];
    echo superHandler($parameters);
});

$router->map('GET|POST', '/signup', function () {
    $parameters = [
        'controller' => 'session/signup.php',
        'view' => 'session/signup.html',
        'title' => 'Sign Up',
        'flashes' => true,
        'restricted' => false,
        'registered' => false,
        'header' => true,
        'footer' => true,
    ];
    echo superHandler($parameters);
});

$router->map('GET|POST', '/about', function () {
    $parameters = [
        'controller' => 'index.php',
        'view' => 'about.html',
        'title' => 'About',
        'flashes' => true,
        'restricted' => false,
        'registered' => false,
        'header' => true,
        'footer' => true,
    ];
    echo superHandler($parameters);
});

$router->map('GET|POST', '/profile', function () {
    $parameters = [
        'controller' => 'user/profile.php',
        'view' => 'user/profile.html',
        'title' => 'My Profile',
        'flashes' => true,
        'restricted' => false,
        'registered' => false,
        'header' => true,
        'footer' => true,
    ];
    echo superHandler($parameters);
});

// AJAX ROUTES

$router->map('GET', '/api/user', function () {
    $parameters = [
        'controller' => 'api/user/user.php',
        'view' => null,
        'title' => null,
        'flashes' => false,
        'restricted' => true,
        'header' => false,
        'footer' => false,
    ];
    echo superHandler($parameters);
});

$router->map('GET', '/api/advertisement/[i:id]', function ($id) {
    $parameters = [
        'controller' => 'api/advertisement/advertisement.php',
        'view' => null,
        'title' => null,
        'flashes' => false,
        'restricted' => false,
        'parameters' => [
            'id' => $id,
        ],
        'header' => false,
        'footer' => false,
    ];
    echo superHandler($parameters);
});

$router->map('GET', '/api/offer/[i:id]', function ($id) {
    $parameters = [
        'controller' => 'api/offer/offer.php',
        'view' => null,
        'title' => null,
        'flashes' => false,
        'restricted' => true,
        'parameters' => [
            'id' => $id,
        ],
        'header' => false,
        'footer' => false,
    ];
    echo superHandler($parameters);
});

$router->map('GET', '/api/offers', function () {
    $parameters = [
        'controller' => 'api/offer/offers.php',
        'view' => null,
        'title' => null,
        'flashes' => false,
        'restricted' => true,
        'header' => false,
        'footer' => false,
    ];
    echo superHandler($parameters);
});

$router->map('GET', '/compile/less', function() {
    require __DIR__ . '/less.compile.php';
});

/**
 * Handles rendering the header, footer, content and initialising the page
 *
 * @param $parameters
 * @return string
 */
function superHandler($parameters) {

    // Set our controller and view directories
    $controllerDirectory = __DIR__ . '/../controllers/';
    $viewDirectory = __DIR__ . '/../views/';

    // Initialise our page array
    $page = Session::init($parameters['title'], $parameters['flashes'], $parameters['restricted']);

    // if parameters are passed, then add them
    if (array_key_exists('parameters', $parameters)) {
        $page['parameters'] = $parameters['parameters'];
    }

    // Require our controller
    require $controllerDirectory . $parameters['controller'];

    // Initialise our h2o object
    $h2o = new h2o(null, array('autoescape' => false));

    $output = "";

    if (array_key_exists('header', $parameters) && $parameters['header'] == true) {
        $h2o->loadTemplate($viewDirectory . 'global/header.html');
        $output .= $h2o->render(compact('page'));
    }

    if ($parameters['view'] != null) {
        $h2o->loadTemplate($viewDirectory . $parameters['view']);
        $output .= $h2o->render(compact('page'));
    }

    if (array_key_exists('footer', $parameters) && $parameters['footer'] == true) {
        $h2o->loadTemplate($viewDirectory . 'global/footer.html');
        $output .= $h2o->render(compact('page'));
    }

    // return output
    return $output;

}

?>