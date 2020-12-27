
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'; // include Composer's autoloader

class DBConnection
{

    public static function getConnection()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "6699";
        $db_name = "ghost_torrents";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    /** online mongod db cluster info 
     * 
     * mongodb+srv://tabish:gameison69@cluster0.gzzwd.mongodb.net/php?retryWrites=true&w=majority
     * 
     * **/
}
?>
