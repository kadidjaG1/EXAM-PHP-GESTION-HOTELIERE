<?php

class Database
{
    private static ?PDO $instance = null;

    private static string $host = '127.0.0.1';
    private static string $dbname = 'postgres';
    private static string $user = 'postgres';
    private static string $pass = 'admin'; 

    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {

            $dsn = "pgsql:host=" . self::$host .
                   ";port=5432;dbname=" . self::$dbname;

            try {

                self::$instance = new PDO(
                    $dsn,
                    self::$user,
                    self::$pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );

            } catch (PDOException $e) {

                die("Erreur de connexion : " . $e->getMessage());

            }

        }

        return self::$instance;
    }
}