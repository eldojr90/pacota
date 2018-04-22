<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite63957e3cb9f721684155fc12bd09c6e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite63957e3cb9f721684155fc12bd09c6e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite63957e3cb9f721684155fc12bd09c6e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
