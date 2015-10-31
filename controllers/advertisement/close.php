<?php

/**
 * @var $page
 */

if ($page['user']['usertype'] != "1") {
    Session::setError('You are not able to close an Advertisement');
    Session::redirect('/');
}

$advertisement = Advertisement::getAdvertisement($page['parameters']['id']);

if ($advertisement == null) {
    Session::setError('Advertisement does not exist');
    Session::redirect('/');
}

if ($advertisement['status'] == "2") {
    Session::setError('Advertisement is already closed');
    Session::redirect('/advertisement/' . $page['parameters']['id']);
}

$closed = Advertisement::close($page['parameters']['id']);

if ($closed) {
    Session::setSuccess('Successfully closed advertisement');
    Session::redirect('/advertisement/' . $page['parameters']['id']);
}

Session::setError('Something went wrong, please try again.');
Session::redirect('/advertisement/' . $page['parameters']['id']);

?>