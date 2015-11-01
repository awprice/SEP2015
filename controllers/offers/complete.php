<?php

/**
 * @var $page
 */

// make sure the offer exists
if ($page['user']['usertype'] == "1") {
    $offer = Offer::getOfferSingle($page['parameters']['id']);
} else {
    $offer = Offer::getOffer($page['parameters']['id'], User::getId());
}

if ($offer == null) {
    Session::setError('Offer does not exist, please check the URL and try again');
    if ($page['user']['usertype'] == "1") {
        Session::redirect('/');
    } else {
        Session::redirect('/profile');
    }
}

// make sure the offer is accepted
if ($offer['status'] != "1") {
    Session::setError('Offer has not been accepted.');
    if ($page['user']['usertype'] == "1") {
        Session::redirect('/advertisement/' . $offer['advertisement']);
    } else {
        Session::redirect('/profile');
    }
}

// make sure the advertisement exists
$advertisement = Advertisement::getAdvertisement($offer['advertisement']);

if ($advertisement == null) {
    Session::setError('Advertisement does not exist, please check the URL and try again');
    if ($page['user']['usertype'] == "1") {
        Session::redirect('/advertisement/' . $offer['advertisement']);
    } else {
        Session::redirect('/profile');
    }
}

// make sure a rating hasn't already been done
$rating = Rating::getRating($offer['id'], User::getId());

if ($rating != null) {
    Session::setError('You have already completed a rating for this offer.');
    if ($page['user']['usertype'] == "1") {
        Session::redirect('/advertisement/' . $offer['advertisement']);
    } else {
        Session::redirect('/profile');
    }
}

// if the form is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ratingScore = (int) $_POST['rating']['score'];
    if ($ratingScore > 5) {
        $ratingScore = 5;
    } elseif ($ratingScore < 1) {
        $ratingScore = 1;
    }

    // create the rating
    if ($page['user']['usertype'] == "1") {
        $newRating = Rating::createRating(
            $offer['owner'],
            $offer['id'],
            $advertisement['id'],
            $ratingScore,
            $_POST['rating']['comments']
        );
    } else {
        $newRating = Rating::createRating(
            $advertisement['owner'],
            $offer['id'],
            $advertisement['id'],
            $ratingScore,
            $_POST['rating']['comments']
        );
    }

    if ($newRating) {

        // try and complete the offer
        Offer::completeOffer($offer['id']);

        Session::setSuccess('Successfully created rating!');
        if ($page['user']['usertype'] == "1") {
            Session::redirect('/advertisement/' . $offer['advertisement']);
        } else {
            Session::redirect('/profile');
        }
    }

    Session::setError('Unable to create rating, an unknown error occured, please try again');
    if ($page['user']['usertype'] == "1") {
        Session::redirect('/advertisement/' . $offer['advertisement']);
    } else {
        Session::redirect('/profile');
    }

}



?>