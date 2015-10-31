<?php

$user = User::getUser();
$page['user'] = $user;

$advertisements = Advertisement::getUserAdvertisements(User::getId());
$page['advertisements'] = $advertisements;

foreach($page['advertisements'] as &$advertisement) {
    if (strlen($advertisement['description']) > 150) {
        $advertisement['description'] = substr($advertisement['description'], 0, 150) . '...';
    }
}

$offers = Offer::getOffersForUser(User::getId());
$page['offers'] = $offers;

foreach($page['offers'] as &$offer) {
    $offer['parentAdvertisement'] = Advertisement::getAdvertisement($offer['advertisement']);
}

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