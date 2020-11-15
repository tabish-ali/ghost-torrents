<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/db-config/db-connection.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';

    $conn = DBConnection::getConnection();

    if (
        isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
        && ($_GET["action"] == "reset") && !isset($_POST["action"])
    ) {


        $error = "";
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

     
    } // isset email key validate end


    if (
        isset($_POST["email"]) && isset($_POST["action"]) &&
        ($_POST["action"] == "update")
    ) {
        $error = "";
        $pass1 = mysqli_real_escape_string($conn, $_POST["pass1"]);
        $pass2 = mysqli_real_escape_string($conn, $_POST["pass2"]);
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        if ($pass1 != $pass2) {
            $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
        }
        if ($error != "") {
            echo "<div class='error'>" . $error . "</div><br />";
        } else {

            $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

            UserDatabase::changePasswordByEmail($email, $hashed_password);

            mysqli_query($conn, "DELETE FROM `password_reset_temp` WHERE `email`='" . $email . "';");

            var_dump($email);
        }
    }


    ?>