<?php

/**
 * @var $page
 */

$user = User::getUser($page['parameters']['id']);

if ($user != null) {
    $page['userProfile'] = $user;
    if ($user['usertype'] == "1") {
        $page['advertisements'] = Advertisement::getUserAdvertisements($user['id']);
    }
} else {
    $page['userProfile'] = null;
}

?>