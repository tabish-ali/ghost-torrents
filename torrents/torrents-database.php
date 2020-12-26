<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/db-config/db-connection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/Torrent.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/size_conversion.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

class TorrentsDatabase
{

    public static function saveTorrent(
        $uploader,
        $description,
        $file_path,
        $category
    ) {

        $date = date_format(DateAndTime::getDate(), "m/d/Y H:i:s");
        $conn = DBConnection::getConnection();
        $insert_query = $conn->prepare("INSERT INTO torrents 
        (description, uploader, category, file_path, date, comments) 
        VALUES(?,?,?,?,?,JSON_ARRAY())");

        $insert_query->bind_param(
            "ssssss",
            $description,
            $uploader,
            $category,
            $file_path,
            $date,
        );

        $insert_query->execute();
        $conn->close();
    }

    public static function saveTorrentFile($torrent_file, $target_dir)
    {

        $target_file = $target_dir . $torrent_file['name'];

        move_uploaded_file($torrent_file["tmp_name"], $target_file);

        return $target_file;
    }

    public static function getTorrent($torrent_id)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM torrents WHERE id = $torrent_id";

        $torrent = $conn->query($select_query);

        $torrent = $torrent->fetch_assoc();

        return $torrent;
    }

    public static function getTorrentMetaInfo($torrent_dir)
    {
        $torrent = new Torrent($torrent_dir);

        $trackers_array = array();

        foreach ($torrent->announce() as $tracker) {

            array_push($trackers_array, $tracker[0]);
        }

        $torrent_info = [
            "name" => $torrent->name(),
            "hash" => $torrent->hash_info(),
            "size" => SizeConversion::humanReadableSize($torrent->size()),
            "trackers" => $trackers_array,
            "content" => $torrent->content(),
            "announce" => $trackers_array[0],
        ];

        return $torrent_info;
    }


    public static function countTotalTorrents($category)
    {
        $conn = DBConnection::getConnection();

        if ($category === "all") {
            $select_query = "SELECT COUNT(*) as total_torrents FROM torrents";
        } else {
            $select_query = "SELECT COUNT(*) as total_torrents FROM torrents WHERE category = '$category'";
        }

        $result = $conn->query($select_query);

        $count = $result->fetch_assoc()['total_torrents'];

        return $count;
    }

    public static function getTorrents($offset, $total_records_per_page)
    {
        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM torrents LIMIT $offset, $total_records_per_page";

        $torrents = $conn->query($select_query);

        $torrents_info_array = array();

        while ($torrent = $torrents->fetch_assoc()) {

            $torrent_meta_info  = TorrentsDatabase::getTorrentMetaInfo($_SERVER['DOCUMENT_ROOT'] .
                $torrent['file_path']);

            $torrents_array = array(
                'description' => $torrent['description'],
                'path' => $torrent['file_path'],
                'id' => $torrent['id'],
                'file_path' => $torrent['file_path'],
                'category' => $torrent['category'],
                'date' => $torrent['date'],
                'magnet' => TorrentsDatabase::getMagnetLink(
                    $torrent_meta_info['name'],
                    $torrent_meta_info['hash'],
                    $torrent_meta_info['announce'],
                    $torrent_meta_info['trackers']
                ),
            );

            array_push($torrents_info_array, array_merge($torrent_meta_info, $torrents_array));
        }

        return $torrents_info_array;
    }

    public static function getMagnetLink($name, $info_hash, $announce, $trackers_array)
    {
        $trackers = '';

        foreach ($trackers_array as $tracker) {

            $trackers = $trackers . '&tr=' . $tracker;
        }

        $magnet = 'magnet:?'
            . 'xt=urn:btih:' . $info_hash
            . '&dn=' . $name
            . '&tr=' . $announce
            . $trackers;

        return $magnet;
    }

    public static function getYTSMagnetLink($name, $info_hash)
    {
        $trackers_array = [
            "udp://open.demonii.com:1337/announce",
            "udp://tracker.openbittorrent.com:80",
            "udp://tracker.coppersurfer.tk:6969",
            "udp://glotorrents.pw:6969/announce",
            "udp://tracker.opentrackr.org:1337/announce",
            "udp://torrent.gresille.org:80/announce",
            "udp://p4p.arenabg.com:1337",
            "udp://tracker.leechers-paradise.org:6969"
        ];

        $trackers = '';

        foreach ($trackers_array as $tracker) {

            $trackers = $trackers . '&tr=' . $tracker;
        }

        $magnet = 'magnet:?'
            . 'xt=urn:btih:' . $info_hash
            . '&dn=' . $name
            . '&tr=' . $trackers;

        return $magnet;
    }

    public static function getTorrentsByCategory($offset, $total_records_per_page, $category)
    {
        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM torrents WHERE category = '$category' LIMIT $offset, $total_records_per_page";

        $torrents = $conn->query($select_query);

        $torrents_info_array = array();

        while ($torrent = $torrents->fetch_assoc()) {

            $torrent_meta_info  = TorrentsDatabase::getTorrentMetaInfo($_SERVER['DOCUMENT_ROOT'] .
                $torrent['file_path']);

            $torrents_array = array(
                'description' => $torrent['description'],
                'path' => $torrent['file_path'],
                'id' => $torrent['id'],
                'category' => $torrent['category'],
                'date' => $torrent['date'],
                'magnet' => TorrentsDatabase::getMagnetLink(
                    $torrent_meta_info['name'],
                    $torrent_meta_info['hash'],
                    $torrent_meta_info['announce'],
                    $torrent_meta_info['trackers']
                ),
            );

            array_push($torrents_info_array, array_merge($torrent_meta_info, $torrents_array));
        }

        return $torrents_info_array;
    }

    public static function insertComment(
        $torrent_id,
        $username,
        $comment,
        $date,
        $comment_id
    ) {

        $comment = array(

            "date" => $date,
            "comment" => $comment,
            "username" => $username,
            "comment_id" => $comment_id,

        );

        $comment = json_encode($comment);

        $conn = DBConnection::getConnection();

        $insert_comment_query = "UPDATE torrents SET 
        comments = JSON_ARRAY_APPEND(comments, '$', CAST('$comment' AS JSON)) 
         WHERE id = $torrent_id";

        /**
         * update torrents set comments = 
         * json_array_append(comments, '$', CAST('{"c1":"1"}' AS JSON)) where id = 5
         */

        $conn->query($insert_comment_query);

        $conn->error;
    }

    public static function getComments($torrent_id)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT comments FROM torrents WHERE id = $torrent_id";

        $result = $conn->query($select_query);

        return $result->fetch_assoc()['comments'];
    }

    public static function getCommentsPos($torrent_id, $comment_id)
    {

        $conn = DBConnection::getConnection();

        $search_query = "SELECT JSON_SEARCH(comments, 'all', '$comment_id', NULL, '$[*].comment_id')
        as POS from torrents WHERE id = $torrent_id";

        $result = $conn->query($search_query);

        $comment_pos = $result->fetch_assoc()['POS'];

        $comment_pos = str_replace('"', "", $comment_pos);

        return explode(".", $comment_pos)[0];
    }

    public static function getCommentsPosByUsername($torrent_id, $username)
    {

        $conn = DBConnection::getConnection();

        $search_query = "SELECT JSON_SEARCH(comments, 'all', '$username', NULL, '$[*].username')
        as POS from torrents WHERE id = $torrent_id";

        $result = $conn->query($search_query);

        $comment_pos = $result->fetch_assoc()['POS'];

        $comment_pos = str_replace('"', "", $comment_pos);

        return explode(".", $comment_pos)[0];
    }

    public static function deleteComment($torrent_id, $pos)
    {
        $conn = DBConnection::getConnection();

        $delete_query = "UPDATE torrents SET comments = JSON_REMOVE(comments, '$pos') 
        WHERE id = $torrent_id";

        $conn->query($delete_query);
    }

    public static function deleteTorrents($selected_torrents)
    {

        $conn = DBConnection::getConnection();

        foreach ($selected_torrents as $torrent) {
            // delete torrent_file also
            unlink($_SERVER['DOCUMENT_ROOT'] . $torrent->file_path);
            $torrent_id = $torrent->id;
            $delete_query = "DELETE FROM torrents WHERE id = $torrent_id";
            $conn->query($delete_query);
        }
        $conn->close();
    }

    public static function updateTorrentInfo($torrent)
    {

        $conn = DBConnection::getConnection();

        $description = $torrent['description'];

        $category = $torrent['category'];

        $torrent_id = $torrent['torrent_id'];

        $update_query = $conn->prepare("UPDATE torrents SET description = ?, category = ?
        WHERE id = $torrent_id");

        $update_query->bind_param("ss", $description, $category);

        $update_query->execute();

        $conn->close();
    }

    public static function updateFile($torrent_id, $file_path)
    {

        $conn = DBConnection::getConnection();

        $update_query = $conn->prepare("UPDATE torrents SET file_path = ? 
        WHERE id = $torrent_id");

        $update_query->bind_param("s", $file_path);

        $update_query->execute();

        $conn->close();
    }
}
