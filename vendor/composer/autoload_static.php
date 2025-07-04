<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit690e04a27fa241bad9da145ee44cf2eb
{
    public static $files = array (
        '88254829cb0eed057c30eaabb6d8edc4' => __DIR__ . '/..' . '/amphp/amp/src/functions.php',
        '429ae5f14a13a9076791c19422e10996' => __DIR__ . '/..' . '/amphp/amp/src/Future/functions.php',
        'c8601a4144b50a7b548da082c89c4dc1' => __DIR__ . '/..' . '/amphp/amp/src/Internal/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Revolt\\' => 7,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Predis\\' => 7,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'K' => 
        array (
            'Kicken\\Gearman\\' => 15,
        ),
        'A' => 
        array (
            'Amp\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Revolt\\' => 
        array (
            0 => __DIR__ . '/..' . '/revolt/event-loop/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Kicken\\Gearman\\' => 
        array (
            0 => __DIR__ . '/..' . '/kicken/gearman-php/src',
        ),
        'Amp\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/amp/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit690e04a27fa241bad9da145ee44cf2eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit690e04a27fa241bad9da145ee44cf2eb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit690e04a27fa241bad9da145ee44cf2eb::$classMap;

        }, null, ClassLoader::class);
    }
}
