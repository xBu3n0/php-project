<?php


class Database {
    private static array $db;
    private static $databaseConfig;
    private PDO $pdo;

    public static function connection(string $connection) {
        if(self::$databaseConfig == null) {
            self::$databaseConfig = require(dirname(__DIR__) . "/../config/database.php");
        }

        $DB = new Database();
        
        if(!isset(self::$db[$connection])) {
            $conn = self::$databaseConfig['connection'][$connection];

            $dsn = "{$conn['DB_CONNECTION']}:host={$conn['DB_HOST']};port={$conn['DB_PORT']};dbname={$conn['DB_DATABASE']}";

            self::$db[$connection] = new PDO($dsn, $conn['DB_USERNAME'], $conn['DB_PASSWORD']);
        }

        $DB->pdo = self::$db[$connection];
        return $DB;
    }

    public function query(string $query) : array {
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}