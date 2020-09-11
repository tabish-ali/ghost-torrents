<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/db-config/db-connection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/show_logs.php';

class DBMigration
{

    public static function createDB()
    {

        $conn = DBConnection::getConnection();

        $create_db_query = "CREATE DATABASE IF NOT EXISTS ghost_torrents";

        if ($conn->query($create_db_query) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
    }

    public static function createUserTable()
    {
    }

    public static function createTorrentsTable()
    {
    }

    public static function createArticlesTable()
    {
    }
}
