<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2cb427fc9b6707ad61a18ed7adc94376
{
    public static $files = array (
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PackageVersions\\' => 16,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
        'J' => 
        array (
            'Jean85\\' => 7,
        ),
        'B' => 
        array (
            'BitTorrent\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PackageVersions\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/package-versions-deprecated/src/PackageVersions',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
        'Jean85\\' => 
        array (
            0 => __DIR__ . '/..' . '/jean85/pretty-package-versions/src',
        ),
        'BitTorrent\\' => 
        array (
            0 => __DIR__ . '/..' . '/christeredvartsen/php-bittorrent/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2cb427fc9b6707ad61a18ed7adc94376::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2cb427fc9b6707ad61a18ed7adc94376::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
