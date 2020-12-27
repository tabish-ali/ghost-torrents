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

        $exp_format = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d"),
            date("Y")
        );

        $exp_date = date("Y-m-d H:i:s", $exp_format);
        $key = md5(2418 * 2 . $user_email);
        $add_key = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $add_key;

        mysqli_query(
            DBConnection::getConnection(),
            "INSERT INTO `password_reset_temp` (`email`, `key`,
        `exp_date`) VALUES('" . $user_email . "',  '" . $key . "', '" . $exp_date . "');"
        );

        $mail = PhpEmail::getPhpMailer();

        $output = '<p>Dear user,</p>';
        $output .= '<p>Please click on the following link to reset your password.</p>';
        $output .= '<p><a href="http://ghost-torrents.com/templates/auth/password-reset.php?key=' . $key . '&email=' . $user_email . '&action=reset" target="_blank">
        http://ghost-torrents.com/templates/auth/password-reset.php?key=' . $key . '&email=' . $user_email . '&action=reset</a></p>';
        $output .= '<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 day for security reason.</p>';
        $output .= '<p>
        

        Hi, welcome from ghost torrents, you have requested to reset password.
        Please make sure to follow the link for password reset or paste the link in your browser.
        If you did not make this request kindly ignore this email. However, you may want to go 
        to your profile to change your password for security purpose, because someone has gussed your email 
        and trying to reset your password.
        
        </p>';

        $output .= '<p>Thanks,</p>';
        $output .= '<p>Ghost Torrents</p>';

        $mail->IsHTML(true);
        $mail->AddAddress($user_email, "user");
        $mail->SetFrom("torrenstghost@gmail.com", "ghost torrents");
        $mail->AddReplyTo("torrentsghost@gmail.com", "ghost torrents");
        $mail->Subject = "Password Reset Request";

        $mail->Body = $output;

        if (!$mail->Send()) {

            echo json_encode(["response" =>  $mail->ErrorInfo]);
        } else {

            echo json_encode(["response" => $email_check]);
        }
    } else {
        echo json_encode(["response" => $email_check]);
    }
}
