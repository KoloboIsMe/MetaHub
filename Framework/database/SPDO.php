<?php

namespace database;

use PDO;

final class SPDO
{
    private static ?SPDO $instance = null;
    private ?PDO $PDOInstance = null;
    private string $serverName;

    private function __construct(string $serverName)
    {
        $config = parse_ini_file(CHEMIN_VERS_FICHIER_INI, true);
        if (isset($config[$serverName])) {
            $serverConfig = $config[$serverName];
            $this->PDOInstance = new PDO($serverConfig['type'] . ':host=' . $serverConfig['IP_adress'] . ';dbname=' . BASE_DE_DONNEES, $serverConfig['user'], $serverConfig['password']);
            $this->PDOInstance->exec('SET CHARACTER SET utf8');
            $this->PDOInstance->setAttribute(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);
            $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            $this->serverName = $serverName;
        } else {
            throw new Exception("Server '$serverName' not found in config file");
        }
    }

    public static function getInstance(string $serverName = 'serveur_admin'): SPDO
    {
        if (is_null(self::$instance) || self::$instance->serverName !== $serverName) {
            self::$instance = new SPDO($serverName);
        }
        return self::$instance;
    }

    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }
}
