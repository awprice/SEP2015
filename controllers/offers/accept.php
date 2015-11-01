<?php

/**
 * @var $page
 */

if ($page['user']['usertype'] != "1") {
    Session::setError('You are not able to accept an Offer');
    Session::redirect('/');
}

$offer = Offer::getOfferSingle($page['parameters']['id']);

if ($offer == null) {
    Session::setError('Offer does not exist');
    Session::redirect('/');
}

$advertisement = Advertisement::getAdvertisement($offer['advertisement']);

if ($advertisement['owner'] != $page['user']['id']) {
    Session::setError('You do not own this offers parent advertisement');
    Session::redirect('/');
}

if ($offer['status'] != "0") {
    Session::setError('Offer can not be accepted.');
    Session::redirect('/');
}

$accepted = Offer::acceptOffer($page['parameters']['id']);

if ($accepted) {
    Session::setSuccess('Successfully accepted offer');
    Session::redirect('/offers/view/' . $offer['advertisement']);
}

Session::setError('Something went wrong, please try again.');
Session::redirect('/offers/view/' . $offer['advertisement']);

?>