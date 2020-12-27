<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php';

session_start();

$user_id = $_SESSION['id'];

$type = $_POST['type'];

$old_password = $_POST['password1'];

$original_password =  UserDatabase::getPassword($user_id);

$check = password_verify($old_password, $original_password);

if ($type === "old_pass_check") {

    if ($check) {
        echo json_encode(["response" => "matched"]);
    } else {
        echo json_encode(["response" => "not-matched"]);
    }


} else {
    $new_password = $_POST['password2'];

    $confirm_new_password = $_POST['password3'];

    if($check){

        $password2 = $_POST['password2'];
        $password3 = $_POST['password3'];

        $hashed_password = password_hash($password2, PASSWORD_DEFAULT);

        UserDatabase::changePassword($user_id, $hashed_password);

        echo json_encode(["response" => "success"]);

    }
    else{
        echo json_encode(["response" => "fail"]);
    }
}
