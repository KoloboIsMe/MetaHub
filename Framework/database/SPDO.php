<?php

namespace database;

use PDO;

final class SPDO
{
    /**
     * @var SPDO|null
     */
    private static ?SPDO $instance = null;
    /**
     * @var PDO|null
     */
    private ?PDO $PDOInstance = null;
    /**
     * @var string
     */
    private string $serverName;

    /**
     * @param string $serverName
     */
    private function __construct(string $serverName)
    {
        try {

            $this->PDOInstance = new PDO('mysql:host=' . getenv('IPADRESS') . ';dbname=' . getenv('DBNAME'), getenv($serverName), getenv($serverName.'PASSWORD'));
            $this->PDOInstance->exec('SET CHARACTER SET utf8');
            $this->PDOInstance->setAttribute(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);
            $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $this->serverName = $serverName;

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * @param string $serverName
     * @return SPDO
     */
    public static function getInstance(string $serverName): SPDO
    {
        if (is_null(self::$instance) || self::$instance->serverName !== $serverName) {
            self::$instance = new SPDO($serverName);
        }
        return self::$instance;
    }

    /**
     * @param $query
     * @return false|\PDOStatement
     */
    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }
}
