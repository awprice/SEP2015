<?php

header('Content-Type: application/json');

$offer = Offer::getOffer($page['parameters']['id'], User::getId());
$success = true;

if ($offer == null) {
    $success = false;
}

echo json_encode([
    'results' => $offer,
    'success' => $success,
]);
exit();

?>