<?php


include_once $_SERVER['DOCUMENT_ROOT'] . '/users/users.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/notifications.php';

$notification = null;

if (isset($_POST['login-btn'])) {

    $username_email = $_POST['username-email'];

    $password = $_POST['password'];

    $response = UserDatabase::getUser($username_email, $password);


    if ($response instanceof Users) {

        $_SESSION['username'] = $response->getUsername();
        $_SESSION['email'] = $response->getEmail();
        $_SESSION['id'] = $response->getId();
        $_SESSION['image'] = $response->getImage();

        header('location: /index.php');

    } else if ($response === "username/email-error") {
        $notification = new Notifications();
        $notification->setNotification("The user with this username/email is not resgistered.");
    } else if ($response === "password-error") {

        $notification = new Notifications();
        $notification->setNotification("Incorrect password entered.");
    }
}
