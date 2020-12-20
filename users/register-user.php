<?php


include_once $_SERVER['DOCUMENT_ROOT'] . '/users/users.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/notifications.php';

$notification = null;

if (isset($_POST['reg-btn'])) {

    $username = $_POST['username'];

    $email = $_POST['email'];

    $password = $_POST['password1'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $notification = new Notifications();

    $flag = false;

    // adding user to database

    if (UserDatabase::checkUser($username)) {

        $flag = true;
    } else {

        $notification->setNotification("User with this username already exists");
        $flag = false;
    }

    if (UserDatabase::checkEmailExistance($email) and $flag) {

        $flag = true;
    } else {
        $flag = false;
    }

    if ($flag) {

        $default_image = "/static/user-images/default-user.svg";
        $id = UserDatabase::registerUser($username, $email, $hashed_password, $default_image);
        $user = new Users($username, $email, $hashed_password, $id, $default_image, false);
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['image'] = $default_image;
        header('location: /index.php');

       
    }

       
}
