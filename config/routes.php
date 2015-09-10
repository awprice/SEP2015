<?php

    $router->map('GET', '/', function () {
       echo superHandler('index.php', 'index.html', 'Index', true, false);
    });

    $router->map('GET', '/david', function () {
       echo superHandler('david/david.php', 'david/david.html', 'david', true, false);
    });

    // Misc routes

	$router->map('GET', '/compile/less', function() {
		require __DIR__ . '/less.compile.php';
	});

    /**
     * Handles rendering the header, footer, content and initialising the page
     *
     * @param $controller
     * @param $view
     * @param $title
     * @param $flashes
     * @param $restricted
     * @return string
     */
    function superHandler($controller, $view, $title, $flashes, $restricted) {

        // Set our controller and view directories
        $controllerDirectory = __DIR__ . '/../controllers/';
        $viewDirectory = __DIR__ . '/../views/';

        // Initialise our page array
        $page = Session::init($title, $flashes, $restricted);

        // Require our controller
        require $controllerDirectory . $controller;

        // Initialise our h2o object
        $h2o = new h2o(null, array('autoescape' => false));

        $output = "";

        // load the templates and render each one
        $h2o->loadTemplate($viewDirectory . 'global/header.html');
        $output .= $h2o->render(compact('page'));

        $h2o->loadTemplate($viewDirectory . $view);
        $output .= $h2o->render(compact('page'));

        $h2o->loadTemplate($viewDirectory . 'global/footer.html');
        $output .= $h2o->render(compact('page'));

        // return output
        return $output;

    }


?>
