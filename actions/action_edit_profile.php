<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/favorite.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/profile.tpl.php');
    $session = new Session();
?>
    <script src="../js/action_edit_profile.tpl.js"></script>
<?php

    if (!$session->isLoggedIn()) die(header('Location: /'));

    $db = getDatabaseConnection();

    $user = User::getUser($db, intval($session->getId()));

    if ($user && $_POST['oldPassword'] == $user->password) { // All good ($error = 0)
        if($_POST['name'] != '') $user->name = $_POST['name'];
        if($_POST['username'] != '') {
            $user->username = $_POST['username'];
            $session->setName($_POST['username']);
        }
        if($_POST['phone'] != '') $user->phone = intval($_POST['phone']);
        if($_POST['newPassword' != '']) $user->password = $_POST['newPassword'];
        $user->save($db);
        
        header('Location: ../pages/profile.php?userId=' . $user->id . '&error=0');
    }
    else if ($_POST['oldPassword'] == '') {
        header('Location: ../pages/profile.php?userId=' . $user->id . '&error=2');
    } 
    else if ($user && $_POST['oldPassword'] != $user->password) { // Password is incorrect ($error = 1)
        header('Location: ../pages/profile.php?userId=' . $user->id . '&error=1');
    }
    else { // If user doesn't exist (Go to the login page)
        header('Location: ../pages/login.php?error=-1');
    }
?>