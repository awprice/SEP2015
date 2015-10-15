<?php

Session::destroySession();
Session::setSuccess('You have been successfully logged out.');
// Redirect to homepage
Session::redirect('/login');

?>