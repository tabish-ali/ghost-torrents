<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'; // include Composer's autoloader


use PHPMailer\PHPMailer\PHPMailer;

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

$mail->IsHTML(true);
$mail->AddAddress("alitabish669@gmail.com", "tabish ali");
$mail->SetFrom("torrenstghost@gmail.com", "ghost torrents");
$mail->AddReplyTo("torrentsghost@gmail.com", "ghost torrents");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}