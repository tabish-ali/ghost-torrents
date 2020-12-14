<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/users/user-database.php";

$message = $_POST['message_obj'];

UserDatabase::contactUs($message);

echo json_encode(["response" => "Your message has been delivered successfully. We will reply you shortly"]);
