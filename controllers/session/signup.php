<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($_POST['signup'] as $key => $value) {
        $result = User::setAttribute($key, $value);
        if ($result == false) {
            Session::setError('Unable to complete your signup, please try again.');
            Session::redirect('/signup');
        }
    }

    Session::setSuccess('Signup complete!');
    Session::redirect('/');

}

?>