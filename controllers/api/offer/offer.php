<?php

header('Content-Type: application/json');

$offer = Offer::getOffer($page['parameters']['id'], User::getId());
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