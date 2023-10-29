<?php

namespace Framework\database;

use database\Exception;
use PDO;

final class Connexion
{
    private PDO $PDO;
    private static Connexion $instance;
    private function __construct(private string $serverName)
    {
        $config = parse_ini_file(INI_FILE_PATH, true);
        if (isset($config[$serverName])) {
            $serverConfig = $config[$serverName];
            $this->PDOInstance = new PDO($serverConfig['type'] . ':host='.
                $serverConfig['IP_adress'] .';dbname='. DATABASES,
                $serverConfig['user'], $serverConfig['password']);
            $this->PDOInstance->exec('SET CHARACTER SET utf8');
            $this->PDOInstance->setAttribute(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);
//            $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } else {
            throw new Exception("Server '$serverName' not found in config file");
        }
    }

    public static function getInstance(string $serverName = 'serveur_admin'): Connexion
    {
        if (is_null(self::$instance) || self::$instance->serverName !== $serverName) {
            self::$instance = new Connexion($serverName);
        }
        return self::$instance;
    }

    public function query($query)
    {
        return $this->PDOInstance->query($query);
    }

    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }
}
