<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';

session_start();

$user_id = $_SESSION['id'];
$current_username = $_SESSION['username'];
$current_email = $_SESSION['email'];
$type = $_POST['type'];


if ($type === "username") {

    $username = $_POST['username'];

    if ($username != $current_username) {

        $check = UserDatabase::checkUsername($user_id, $username);

        if ($check) {
            UserDatabase::updateUsername($user_id, $username);
            $_SESSION['username'] = $username;
            echo json_encode(["response" => "updated"]);
        } else {
            echo json_encode(["response" => "taken"]);
        }
    } else {
        echo json_encode(["response" => "no-change"]);
    }


} else if ($type == "email") {
    $email = $_POST['email'];
    if ($email != $current_email) {
        $check = UserDatabase::checkEmail($user_id, $email);
        if ($check) {
            UserDatabase::updateEmail($user_id, $email);
            $_SESSION['email'] = $email;
            echo json_encode(["response" => "updated"]);
        } else {
            echo json_encode(["response" => "taken"]);
        }
    } else {
        echo json_encode(["response" => "no-change"]);
    }
} else if ($type == "intro") {
    $intro = $_POST['intro'];
    UserDatabase::updateIntro($user_id, $intro);
    echo json_encode(["response" => "updated"]);
}
