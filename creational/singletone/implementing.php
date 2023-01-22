<?php

final class Db
{
    private static ?self $_instance = null;
    private static $_connection;

    private function __construct()
    {
        $settings = require __DIR__ . '/settings.php';

        $connectionString = $settings['driver'] . ':host=' . $settings['host'] . ';port=' . $settings['db_port'] . ';dbname=' . $settings['db_name'];

        try {
            // Connect to database. Late Static Bindings
            static::$_connection = new PDO($connectionString, $settings['username'], $settings['password'], $settings['options']);
            static::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            static::$_connection->query('SET NAMES utf8');
            static::$_connection->query('SET CHARACTER SET utf8');
        } catch (PDOException $e) {
            die("PDO Error: " . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (!static::$_instance) {
            static::$_instance = new static(); // Late Static Bindings
        }

        return static::$_instance;
    }

    public function getConnection(): PDO
    {
        return static::$_connection;
    }

    private function __clone(): void
    {
    }

    public function __wakeup(): void
    {
    }
}
