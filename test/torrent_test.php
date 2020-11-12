<?php

require '../vendor/autoload.php';

include $_SERVER['DOCUMENT_ROOT'] . '/config/show_logs.php';

// function bencode($var)
// {
//     if (is_int($var)) {
//         return 'i' . $var . 'e';
//     } else if (is_array($var)) {
//         if (count($var) == 0) {
//             return 'de';
//         } else {
//             $assoc = false;
//             foreach ($var as $key => $val) {
//                 if (!is_int($key)) {
//                     $assoc = true;
//                     break;
//                 }
//             }
//             if ($assoc) {
//                 ksort($var, SORT_REGULAR);
//                 $ret = 'd';
//                 foreach ($var as $key => $val) {
//                     $ret .= bencode($key) . bencode($val);
//                 }
//                 return $ret . 'e';
//             } else {
//                 $ret = 'l';
//                 foreach ($var as $val) {
//                     $ret .= bencode($val);
//                 }
//                 return $ret . 'e';
//             }
//         }
//     } else {
//         return strlen($var) . ':' . $var;
//     }
// }


// $decoder = new BitTorrent\Decoder();
// $decodedFile = $decoder->decodeFile('[limetorrents.info]Femdom--Megan.-.Vicious.Russian.Mistress.-.720p.torrent');

// var_dump($decodedFile['info']['name']);

// var_dump($decodedFile['announce-list']);

// var_dump($decodedFile['announce']);


// foreach ($decodedFile['info']['files'] as $file) {

//     $size = sizeof($file['path']); // means it contains directory

//     if ($size > 1)
//         foreach ($file['path'] as $path) {

//             echo nl2br($path . "/");
//         }
// }


// function human_filesize($size, $precision = 2)
// {
//     $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
//     $step = 1024;
//     $i = 0;
//     while (($size / $step) > 0.9) {
//         $size = $size / $step;
//         $i++;
//     }
//     return round($size, $precision) . $units[$i];
// }

// $info_hash = sha1(bencode($decodedFile['info']), true);

// var_dump(bin2hex($info_hash));

require_once 'Torrent.php';

// create torrent
// $torrent = new Torrent('Vicious.Russian.Mistress.720p.torrent');
// if (!$error = $torrent->error()) // error method return the last error message
//     $torrent->save('test.torrent'); // save to disk


// print torrent infos
$torrent = new Torrent($_SERVER['DOCUMENT_ROOT'] .
    '/static/torrent-statics/torrent-files/endzone-a-world-apart-v0_7_7517.torrent');

echo '<pre>private: ', $torrent->is_private() ? 'yes' : 'no',
    '<br>annonce: ';
echo '<br>name: ', $torrent->name(),
    '<br>comment: ',
    $torrent->comment(),
    '<br>piece_length: ',
    $torrent->piece_length(),
    '<br>size: ',
    $torrent->size(2),
    '<br>hash info: ',
    $torrent->hash_info(),
    '<br>stats: ';
var_dump($torrent->scrape());
echo '<br>content: ';
var_dump($torrent->content());

$trackers_array = array();

foreach ($torrent->announce() as $tracker) {

    echo "<small>" . $tracker[0] . "</small><br>";

    array_push($trackers_array, $tracker[0]);
}

require 'scraper.php';

$scraper = new Scrapeer\Scraper();


$info = $scraper->scrape($torrent->hash_info(), $trackers_array);


var_dump($info);

foreach ($info as $i) {

    echo "<hr>";
    echo " <small> Seeders: " . $i['seeders'] . "</small>";
    echo " <small> Completed: " . $i['completed'] . "</small>";
    echo " <small> Leechers: " . $i['leechers'] . "</small>";
}
