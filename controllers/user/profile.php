<?php

$user = User::getUser();
$page['user'] = $user;

$advertisements = Advertisement::getUserAdvertisements(User::getId());
$page['advertisements'] = $advertisements;

foreach($page['advertisements'] as &$advertisement) {
    // trim the description
    if (strlen($advertisement['description']) > 150) {
        $advertisement['description'] = substr($advertisement['description'], 0, 150) . '...';
    }
}

$offers = Offer::getOffersForUser(User::getId());
$page['offers'] = $offers;

foreach($page['offers'] as &$offer) {
    // trim the description
    if (strlen($offer['description']) > 150) {
        $offer['description'] = substr($offer['description'], 0, 150) . '...';
    }
    $offer['parentAdvertisement'] = Advertisement::getAdvertisement($offer['advertisement']);

    // get the owner details if the offer has been accepted
    if ($offer['status'] == "1") {
        $offer['ownerDetails'] = User::getUser($offer['parentAdvertisement']['owner']);
    }

}

// if it is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateUser = User::updateUser($_POST['profile']);

    if ($updateUser) {
        Session::setSuccess('Details updated successfully!');
        Session::redirect('/');
    }

    Session::setError('Unable to update details, please try again.');
    Session::redirect('/profile');
}

?>