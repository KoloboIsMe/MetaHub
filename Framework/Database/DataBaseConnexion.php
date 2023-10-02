<?php
namespace Database;
use PDO;

class dataBaseConnexion
{
    private $dbHost = '127.0.0.1';
    private $dbPassword;
    private $dbUsername = 'root';
    private $dbName = 'projetwebphp';
    private $pdo = null;

    public function __construct()
    {
        if (!$this->getPDO() == null) {
            return;
        } else {
            $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName";
            $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword);
            $pdo->exec('SET CHARACTER SET utf8');
            $this->pdo = $pdo;
            //voir exception
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}