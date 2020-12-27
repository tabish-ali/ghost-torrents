<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/db-config/db-connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php';

$conn = DBConnection::getConnection();

$message = "";
$row = "";

if (
    isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
    && ($_GET["action"] == "reset") && !isset($_POST["action"])
) {


    $message="";
    $key = $_GET["key"];
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    $query = mysqli_query(
        $conn,
        "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';"
    );

    $row = mysqli_num_rows($query);

    if (!$row == "") {
        $row = mysqli_fetch_assoc($query);
        $exp_date = $row['exp_date'];
    }
}

if (
    isset($_POST["email"]) && isset($_POST["action"]) &&
    ($_POST["action"] == "update")
) {
    $pass1 = mysqli_real_escape_string($conn, $_POST["pass1"]);
    $pass2 = mysqli_real_escape_string($conn, $_POST["pass2"]);
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");

    if ($pass1 != $pass2) {
        $message = "Password do not match, both password should be same.";
    } else {

        $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

        UserDatabase::changePasswordByEmail($email, $hashed_password);

        mysqli_query($conn, "DELETE FROM `password_reset_temp` WHERE `email`='" . $email . "';");

        $message = "Your password has been reset successfully";
    }
}
