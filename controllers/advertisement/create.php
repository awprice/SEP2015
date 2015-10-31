<?php

/**
 * @var $page
 */

if ($page['user']['usertype'] != "1") {
    Session::setError('You are not able to create an Advertisement');
    Session::redirect('/');
}

// if the form is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = Advertisement::getNextId();

    $startdate = strtotime($_POST['advertisement']['startdate']);
    $enddate = strtotime($_POST['advertisement']['enddate']);

    $newAdvertisement = Advertisement::createAdvertisement(
        User::getId(),
        $_POST['advertisement']['title'],
        $startdate,
        $enddate,
        $_POST['advertisement']['description'],
        $_POST['advertisement']['location'],
        $_POST['advertisement']['category'],
        $_POST['advertisement']['salary'],
        $_POST['advertisement']['tags']
    );

    if ($newAdvertisement) {
        Session::setSuccess('Successfully created advertisement!');
        Session::redirect('/advertisement/' . $id);
    }

    Session::setError('Unable to create advertisement, an unknown error occured, please try again');
    Session::redirect('/');

}



?>