<?php

/**
 * @var $page
 */

$query = urldecode($page['parameters']['query']);
$page['advertisements'] = Advertisement::searchAdvertisement($query);

$page['resultSize'] = count($page['advertisements']);
$page['query'] = $query;

?>