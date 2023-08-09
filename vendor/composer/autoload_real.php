<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit7a18d3c31b27dfce4c20b955d48a832e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit7a18d3c31b27dfce4c20b955d48a832e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit7a18d3c31b27dfce4c20b955d48a832e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit7a18d3c31b27dfce4c20b955d48a832e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
