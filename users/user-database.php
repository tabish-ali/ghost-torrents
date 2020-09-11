<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/db-config/db-connection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/users/users.php');

class UserDatabase
{

    public static function registerUser($username, $email, $password, $image)
    {
        $conn = DBConnection::getConnection();

        $insert_query = $conn->prepare("INSERT INTO users (username, email, password, image_path)
        VALUES(?,?,?,?)");

        $insert_query->bind_param("ssss", $username, $email, $password, $image);

        $insert_query->execute();

        $conn->close();

        $insert_query->close();

        $new_user = UserDatabase::getLastID();

        return $new_user['id'];
    }

    public static function getLastID()
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";

        $result = $conn->query($select_query);

        return $result->fetch_assoc();
    }

    public static function getUser($email_username, $password)
    {

        // get user on basis of email or username

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM users WHERE username = '$email_username' 
        OR email ='$email_username'";

        $result = $conn->query($select_query);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $user_password =  $row['password'];
                $username = $row['username'];
                $email = $row['email'];
                $id = $row['id'];
                $image = $row['image_path'];
            }

            if (UserDatabase::verifyPassword($password, $user_password)) {
                $user = new Users($username, $email, $user_password, $id, $image);
                return $user;
            } else {
                return "password-error";
            }
        } else {
            return "username/email-error";
        }
    }

    public static function getUserById($user_id)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM users WHERE id = '$user_id'";

        $result = $conn->query($select_query);

        return $result->fetch_assoc();
    }

    public static function verifyPassword($input_password, $user_password)
    {
        return password_verify($input_password, $user_password);
    }

    // checking for username if it already exists
    public static function checkUser($username)
    {
        $conn = DBConnection::getConnection();

        $check_query = "SELECT username FROM users WHERE username = '$username'";

        $result = $conn->query($check_query);

        return $result->num_rows == 0;
    }

    public static function updateUsername($user_id, $username)
    {

        $conn = DBConnection::getConnection();

        $update_query = "UPDATE users SET username = '$username' WHERE id = $user_id";

        $conn->query($update_query);
    }

    public static function updateEmail($user_id, $email)
    {
        $conn = DBConnection::getConnection();

        $update_query = "UPDATE users SET email = '$email' WHERE id = $user_id";

        $conn->query($update_query);
    }

    public static function changePassword($user_id, $new_password)
    {

        $conn = DBConnection::getConnection();

        $update_query = "UPDATE users SET password = '$new_password' WHERE id = $user_id";

        $conn->query($update_query);
    }

    public static function getPassword($user_id)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT password FROM users WHERE id = $user_id";

        $result = $conn->query($select_query);

        $row =  $result->fetch_assoc();

        return $row['password'];
    }

    // this function checks if username already exist
    public static function checkUsername($user_id, $username)
    {
        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM users WHERE id != $user_id AND username = '$username'";

        $result = $conn->query($select_query);

        return $result->num_rows == 0;
    }

    public static function checkEmail($user_id, $email)
    {
        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM users WHERE id != $user_id AND email = '$email'";

        $result = $conn->query($select_query);

        return $result->num_rows == 0;
    }


    public static function checkEmailExistance($email)
    {
        $conn = DBConnection::getConnection();

        $check_query = "SELECT email FROM users WHERE email = '$email'";

        $result = $conn->query($check_query);

        return $result->num_rows == 0;
    }


    public static function saveImagePath($user_id, $image_path)
    {
        $conn = DBConnection::getConnection();

        $save_query = "UPDATE users SET image_path = '$image_path' WHERE id = $user_id";

        $conn->query($save_query);

        echo $conn->error;
    }

    public static function updateIntro($user_id, $intro)
    {
        $conn = DBConnection::getConnection();

        $update_query = "UPDATE users SET intro = '$intro' WHERE id = $user_id";

        $conn->query($update_query);
    }
    public static function getUserImage($username)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT image_path FROM users WHERE username = '$username'";

        $result = $conn->query($select_query);

        $image_path = $result->fetch_assoc()['image_path'];

        return $image_path;
    }
}
