<?php

header('Content-Type: application/json');

$offers = Offer::getOffersForUser(User::getId());
$success = true;

if ($offers == null) {
    $success = false;
}

echo json_encode([
    'results' => $offers,
    'success' => $success,
]);
exit();

?>