<?php

header('Content-Type: application/json');

$advertisement = Advertisement::getAdvertisement($page['parameters']['id']);
$success = true;

if ($advertisement == null) {
    $success = false;
}

echo json_encode([
    'results' => $advertisement,
    'success' => $success,
]);
exit();

?>