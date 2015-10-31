<?php

/**
 * @var $page
 */

// Make sure the user is a user that can make an offer
$user = User::getUser();

if ($user['usertype'] != "0") {
    Session::setError('You are not the correct user type to make an offer');
    Session::redirect('/');
}

// Make sure it is a valid advertisement and it can take offers
$advertisement = Advertisement::getAdvertisement($page['parameters']['id']);

if ($advertisement == null || $advertisement['status'] != "1") {
    Session::setError('This advertisement does not exist or is not able to be offered.');
    Session::redirect('/');
}

$page['advertisement'] = $advertisement;

// Check if this user has already made an offer
$offers = Offer::getOffersForUser(User::getId());

foreach ($offers as $offer) {
    if ($offer['advertisement'] == $page['parameters']['id']) {
        Session::setError('You have already sent an offer for this Advertisement.');
        Session::redirect('/advertisement/' . $page['parameters']['id']);
    }
}

// if the form is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newOffer = Offer::createOffer(User::getId(), $page['parameters']['id'], $_POST['makeOffer']['description']);

    if ($newOffer) {
        Session::setSuccess('Successfully added offer!');
        Session::redirect('/profile');
    }

    Session::setError('Unable to create offer, an unknown error occured, please try again');
    Session::redirect('/advertisement/' . $page['parameters']['id']);

}

?>