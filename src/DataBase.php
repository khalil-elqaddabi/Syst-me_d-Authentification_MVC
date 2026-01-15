<?php
namespace App;
class Database {
    private static ?\PDO $pdo =null;

    public static function getconnection(): \PDO {
        if (self::$pdo ===null) {
            $config =require __DIR__ ."/../config/DataBase.php";
            $dsn = "myssql:host={$config['host']};dbname={$config['dbname']};charset{$config['charset']}";

            self::$pdo =new \PDO($dsn, $config['user'], $config['password'],[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,]);
        }
        return self::$pdo;
    }
}