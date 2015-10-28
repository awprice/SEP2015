<?php

$advertisement = Advertisement::getAdvertisement($page['parameters']['id']);

if ($advertisement != null) {
    $page['advertisement'] = $advertisement;

    // Format dates
    $page['advertisement']['startdate'] = date("jS M Y - g:ia", $page['advertisement']['startdate']);
    $page['advertisement']['enddate'] = date("jS M Y - g:ia", $page['advertisement']['enddate']);
    $page['advertisement']['created'] = date("jS M Y - g:ia", $page['advertisement']['created']);

    // split tags
    $page['advertisement']['tags'] = explode (',', $page['advertisement']['tags']);
    foreach($page['advertisement']['tags'] as &$tag) {
        $tag = trim($tag);
    }


} else {
    $page['advertisement'] = null;
}

?>