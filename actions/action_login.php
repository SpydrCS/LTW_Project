<?php
    include_once('../database/user.class.php');
    include_once('../database/connection.db.php');
    include_once('../utils/session.php');
?>

<?php
    $username = $_POST['username'];
    $password = md5($_POST['password']); //encripts password as soon as it gets it (will work with encripted value at all times)

    $db = getDatabaseConnection();
    $userExists = User::userExists($db, $username);

    if ($userExists == 1) { // User exists
        $user = User::getUserByUsername($db, $username);
        if ($user) {
            if ($user->username == $username && $user->password == $password) { // ($error = 0) All good!
                $session = new Session();
                $session->setName($user->username);
                $session->setId($user->id);
                header('Location: ../pages/index.php?userUsername=' . $user->username);
            }
            else if ($user->username == $username && $user->password != $password) { // ($error = 1) Wrong password
                header('Location: ../pages/login.php?error=1');
            }
            else { // ($error = 3) Other errors
                header('Location: ../pages/login.php?error=3');
            }
        }
    }
    else { // ($error = 2) User does not exist
        header('Location: ../pages/login.php?error=2');
    }
?>