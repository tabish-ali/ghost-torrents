<?php

class SizeConversion
{

    public static function humanReadableSize($size, $precision = 2)
    {

        for ($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {
        }
        return round($size, $precision) . [' B', ' kB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB'][$i];
    }
}
