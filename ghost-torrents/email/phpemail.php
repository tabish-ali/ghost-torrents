<?php

require $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/vendor/autoload.php'; // include Composer's autoloader


use PHPMailer\PHPMailer\PHPMailer;

class PhpEmail
{

  public static function getPhpMailer()
  {

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "torrentsghost@gmail.com";
    $mail->Password   = "nothing matters now 669";

    return $mail;
  }
}
