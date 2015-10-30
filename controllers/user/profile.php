<?php

$user = User::getUser();

if($user != null)
{

    $page['user'] = $user;

    $offers = Offer::getOffersForUser(User::getId());

    if($offers != null)
    {
        $page['offers'] = $offers;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Session::setSuccess('Test');
    $updateUser = User::updateUser($_POST['profile']);

    if ($updateUser) {
        Session::setSuccess('Details updated successfully!');
        Session::redirect('/');
    }
    Session::setError('Unable to update details, please try again.');
    Session::redirect('/profile');
}

?>