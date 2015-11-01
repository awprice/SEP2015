<?php

/**
 * @var $page
 */

$user = User::getUser($page['parameters']['id']);

if ($user != null) {
    $page['userProfile'] = $user;

    // get the user's rating
    $rating = Rating::getUserRating($user['id']);
    $stars = [];
    for ($x = 1; $x <= $rating; $x++) {
        $stars[] = '1';
    }
    if (count($stars) != 5) {
        $size = count($stars);
        for ($x = 1; $x <= (5 - $size); $x++) {
            $stars[] = '0';
        }
    }
    $page['userProfile']['rating'] = $stars;

    // Get the user's advertisements if applicable
    if ($user['usertype'] == "1") {

        $advertisements = Advertisement::getUserAdvertisements($user['id']);

        // trim the description
        foreach ($advertisements as &$advertisement) {
            if (strlen($advertisement['description']) > 150) {
                $advertisement['description'] = substr($advertisement['description'], 0, 150) . '...';
            }
        }

        $page['advertisements'] = $advertisements;
    }
} else {
    $page['userProfile'] = null;
}

?>