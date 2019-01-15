<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit96e77def33538a1b12f539392a539a83
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Riimu\\Kit\\ClassLoader\\' => 22,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
		'A' => 
        array (
            'ADOdb\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Riimu\\Kit\\ClassLoader\\' => 
        array (
            0 => __DIR__ . '/..' . '/riimu/kit-classloader/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
		'ADOdb\\' => 
        array (
            0 => __DIR__ . '/..' . '/adodb/adodb/src/ADOdb',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit96e77def33538a1b12f539392a539a83::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit96e77def33538a1b12f539392a539a83::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
