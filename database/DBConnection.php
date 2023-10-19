<?php

namespace Database;

use PDO;

class DBConnection
{
    private static $instance = null;
    private $dbHost = 'mysql-metahub.alwaysdata.net';
    private $dbPassword = "MetaHubAdmin13.";
    private $dbUsername = 'metahub';
    private $dbName = 'metahub_login';
    private $pdo;

    private function __construct()
    {
        $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword);
        $pdo->exec('SET CHARACTER SET utf8');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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