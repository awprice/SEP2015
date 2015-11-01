<?php

/**
 * @var $page
 */

// make sure user can view this page
if ($page['user']['usertype'] != "1") {
    Session::setError('You are not able to view offers for an advertisement');
    Session::redirect('/');
}

// make sure is valid advertisement
$advertisement = Advertisement::getAdvertisement($page['parameters']['id']);

if ($advertisement == null) {
    Session::setError('Advertisement does not exist.');
    Session::redirect('/');
}

// make sure the advertisement is owned by the user
if ($advertisement['owner'] != $page['user']['id']) {
    Session::setError('You do not own this advertisement');
    Session::redirect('/');
}

$page['advertisement'] = $advertisement;

$offers = Offer::getOffersForAdvertisement($advertisement['id']);
$page['offers'] = $offers;

foreach ($page['offers'] as &$offer) {
    $offer['ownerDetails'] = User::getUser($offer['owner']);
}

?>