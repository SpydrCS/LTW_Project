<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/profile.tpl.php');
    $session = new Session();
?>

<?php

    if (!$session->isLoggedIn()) die(header('Location: /'));

    $db = getDatabaseConnection();

    $user = User::getUser($db, intval($session->getId()));

    $name = $_POST['name'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    if ($name != '' && $address != '' && $type != '') {
        $user->addNewRestaurant($db, $session->getId(), $name, $address, $type);
        header('Location: ../pages/profile.php?userId=' . $user->id . '&error=3'); // Success!
    }

    header('Location: ../pages/profile.php?userId=' . $user->id . '&error=-2'); // Fill all the cells
?>