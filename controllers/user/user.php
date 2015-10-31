<?php

/**
 * @var $page
 */

$user = User::getUser($page['parameters']['id']);

if ($user != null) {
    $page['userProfile'] = $user;
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