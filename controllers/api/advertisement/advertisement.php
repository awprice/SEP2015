<?php

header('Content-Type: application/json');

$advertisement = Advertisement::getAdvertisement($page['parameters']['id']);

echo json_encode([
    'results' => $advertisement,
    'success' => true,
]);
exit();

?>