<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/email/phpemail.php";
include_once  $_SERVER['DOCUMENT_ROOT'] . "/users/user-database.php";

$request_type = $_POST['type'];

if ($request_type == "password_reset") {

    passwordReset();
}

function passwordReset()
{
    // first we will check if email exist in database

    $user_email  = $_POST['email'];

    $email_check  = !UserDatabase::checkEmailExistance($user_email);

    if ($email_check) {

        $mail = PhpEmail::getPhpMailer();

        $mail->IsHTML(true);
        $mail->AddAddress($user_email, "user");
        $mail->SetFrom("torrenstghost@gmail.com", "ghost torrents");
        $mail->AddReplyTo("torrentsghost@gmail.com", "ghost torrents");
        $mail->Subject = "Password Reset Request";

        $code = mt_rand(100000, 999999);

        UserDatabase::enterPasswordCode($user_email, $code);

        $content = '
    <h3 style="background-color: #2f2f2f; color:aliceblue; padding:5px; border-radius: 5px;">
    Ghost Torrents
    </h3>
    <p>Hi you have made a request to reset your password. 
    This six digit key is your password now. 
    Please update your password as soon as possible. Conside this as your temporary password.
    If you have not made this request then some one else is trying to reset your password.
    Please report to us using contact form. <br><br>

    <span style="margin-top:5px; padding: 1px; border: 1px solid lightgray;">
    PASS KEY: ' . '<b style="letter-spacing: 2px;">'
            . $code . '</b> ' .
            ' </span>

    <h4> Team Ghost </h4>
    ';

        $mail->MsgHTML($content);

        if (!$mail->Send()) {
            echo json_encode(["response" => $mail]);
        } else {
            echo json_encode(["response" => $email_check]);
        }
    } else {
        echo json_encode(["response" => $email_check]);
    }
}
