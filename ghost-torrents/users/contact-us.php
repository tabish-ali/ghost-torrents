<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'."/users/user-database.php";

$message_obj = $_POST['message_obj'];

UserDatabase::contactUs($message_obj);

echo json_encode([
    "response" => "Your message has been delivered successfully.<br>
We will reply you shortly.
Thanks " . $message_obj['name']. ".",
    "message" => $message_obj,
]);
