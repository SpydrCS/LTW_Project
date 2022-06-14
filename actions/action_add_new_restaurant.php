<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/favourite.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/profile.tpl.php');
    $session = new Session();
?>

<?php

if (!$session->isLoggedIn()) die(header('Location: /'));

$restaurant_name = $_POST['restaurant-name'];
$address = $_POST['restaurant-address'];
$type = $_POST['restaurant-type'];

Restaurant::addRestaurant($session->getId(), $restaurant_name, $restaurant_address, $type);
?>