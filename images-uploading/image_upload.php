<?php

include_once $_SERVER['DOCUMENT_ROOT'] .'/config/notifications.php';

class SaveImages
{

    public static function uploadImage($image_file, $image_file_name, $target_dir)
    {
        // show error notifications if any occurs

        $error = new Notifications();

        $target_file = $target_dir . $image_file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($image_file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error->setNotification("File is not an image.");
            $uploadOk = 0;
        }

        // Check file size
        if ($image_file["size"] > 3000000) {
            $error->setNotification("Sorry, your file is too large. Max size (3-MB)");
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error->setNotification("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error->setNotification("Sorry, your file was not uploaded.");
            return $error;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
                // echo "The Image has been uploaded.";
            } else {
                $error->setNotification("Sorry, there was an error uploading your file.");
                return $error;
            }
        }
    }
}
