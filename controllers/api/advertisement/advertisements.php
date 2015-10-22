<?php

header('Content-Type: application/json');

$advertisements = Advertisement::getAdvertisements($page['parameters']['page']);
$success = true;

if ($advertisements == null) {
    $success = false;
}

$amount = Advertisement::getAdvertisementCount();
$totalPages = ceil($amount / 10);

echo json_encode([
    'results' => $advertisements,
    'success' => $success,
    'count' => $amount,
    'totalpages' => $totalPages,
]);
exit();

?>