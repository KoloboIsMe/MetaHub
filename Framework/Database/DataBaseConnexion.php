<?php
namespace Framework\Database;
use PDO;

class dataBaseConnexion
{
    private static $instance = null;

    private $dbHost = '127.0.0.1';
    private $dbPassword;
    private $dbUsername = 'root';
    private $dbName = 'metahub';
    private $pdo;

    private function __construct()
    {
        $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword);
        $pdo->exec('SET CHARACTER SET utf8');
        $this->pdo = $pdo;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}