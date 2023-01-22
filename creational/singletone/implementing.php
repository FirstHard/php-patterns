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
            // Connect to database.
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
            static::$_instance = new static();
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

// Tests

// $stmt = new Db(); // Fatal error: Uncaught Error: Call to private Db::__construct() from global scope
$db_instance = Db::getInstance();
$db_connection = $db_instance->getConnection();
var_dump($db_instance); // class Db#1 (0) { }
var_dump($db_connection); // class PDO#2 (0) { }
$db_instance2 = Db::getInstance();
$db_connection2 = $db_instance2->getConnection();
var_dump($db_instance2); // class Db#1 (0) { }
var_dump($db_connection2); // class PDO#2 (0) { }

$sqlExample = 'SELECT * FROM `user`';
try {
    $stm = $db_connection->prepare($sqlExample);
    $stm->execute();
} catch (\PDOException $e) {
    die("PDO Error: " . $e->getMessage());
}

var_dump($stm->fetchAll(PDO::FETCH_ASSOC)); // array()
var_dump($db_connection->errorInfo()); // array()
var_dump($db_instance === $db_instance2); // true
var_dump($db_connection === $db_connection2); // true
