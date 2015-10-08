<?php

// Redirect to the home page if they are already logged in
if (User::isLoggedIn()) {
    Session::setError('You are already logged in.');
    Session::redirect('/');
}

// If the request is post, try and log them in
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // check whether the posted fields are empty

    if (!empty($_POST['login']['email']) && !empty($_POST['login']['password'])) {
        // try and log the user in
        if (User::attemptLogin($_POST['login']['email'], $_POST['login']['password'])) {
            $_SESSION['id'] = User::getUserId($_POST['login']['email']);
            Session::setSuccess('You have successfully been logged in.');
            Session::redirect('/');
        } else {
            Session::setError('Your Email or Password was incorrect or the account does not exist, please try again.');
            Session::redirect('/login');
        }
    } else {
        // set error message and redirect
        Session::setError('Unable to log you in, one or more fields was empty');
        Session::redirect('/login');
    }
}

?>