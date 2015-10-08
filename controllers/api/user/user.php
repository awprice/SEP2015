<?php

    header('Content-Type: application/json');

    $user = User::getUser();
    unset($user['password']);

    echo json_encode([
        'results' => $user,
        'success' => true,
    ]);
    exit();

?>