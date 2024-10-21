<?php

// connecting to mysql database
class Database
{
    private static $username;
    private static $password;
    private static $server;
    private static $database;
    private static $instance = false;

    #public function __construct(){;}
    public static function getInstance($config)
    {
        return self::_setInstance($config);
    }

    /**
     * @return  \PDO object
     */
    private static function _setInstance($config)
    {
        if (!self::$instance) {
            self::$username     = $config['username'];
            self::$password     = $config['password'];
            self::$server       = $config['server'];
            self::$database     = $config['schema'];

            $dsn = 'mysql:host=' . self::$server . ';dbname=' . self::$database;
            $opt = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];

            self::$instance = new \PDO(
                $dsn,
                self::$username,
                self::$password,
                $opt
            );

            return self::$instance;
        }

        return self::$instance;
    }
}
