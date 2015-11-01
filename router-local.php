<?php

    	// Import our modules
    	require __DIR__ . '/modules/AltoRouter/AltoRouter.php';
    	require __DIR__ . '/modules/h2o-php/h2o.php';

        // Import our models
    	require __DIR__ . '/models/autoload.php';

    	// Import our config files
    	require __DIR__ . '/config/session.php';
    	require __DIR__ . '/config/config-local.php';
    	require __DIR__ . '/config/content_types.php';

    	$router = new AltoRouter();
    	require __DIR__ . '/config/routes.php';

    	$match = $router->match();

    	$extension = pathinfo($_SERVER["REQUEST_URI"])["extension"];

    	if ($match && is_callable($match['target'])) {
        	call_user_func_array($match['target'], $match['params']);
    	} else if (is_file(__DIR__ . $_SERVER["REQUEST_URI"]) && array_key_exists($extension, $content_types)) {
        	header('Content-Type: ' . $content_types[$extension]);
        	readfile(__DIR__ . $_SERVER["REQUEST_URI"]);
   	} else {
			Session::redirect('/404');
    	}

?>
