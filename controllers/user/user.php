<?php

/**
 * @var $page
 */

$user = User::getUser($page['parameters']['id']);

if ($user != null) {
    $page['userProfile'] = $user;

    // get the user's rating
    $rating = Rating::getUserRating($user['id']);
    $page['userProfile']['rating'] = Rating::getStarsArray($rating);

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