<?php

	// Import our modules
	require __DIR__ . '/modules/AltoRouter/AltoRouter.php';
	require __DIR__ . '/modules/h2o-php/h2o.php';

    	// Import our models
    	require __DIR__ . '/models/autoload.php';

	// Import our config files
    	require __DIR__ . '/config/session.php';
	require __DIR__ . '/config/config.php';

	$router = new AltoRouter();
	require __DIR__ . '/config/routes.php';

	$match = $router->match();

    	header("X-Processed-By: AltoRouter");

	if ($match && is_callable($match['target'])) {
		call_user_func_array($match['target'], $match['params']);
	} else {
		http_response_code(404);
		echo '404 Not Found';
	}

?>
