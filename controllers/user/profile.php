<?php

$user = User::getUser();

if($user != null)
{

    $page['user'] = $user;

    $offers = Offer::getOffersForUser(User::getId());

    if($offers != null)
    {
        $page['offers'] = $offers;
    }
}

?>