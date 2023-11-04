<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  CONNEXION  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Singleton which represents the connexion to a database.

namespace Framework\database;

use PDO;

final class Connexion
{
    private PDO $PDO;
    private static ?Connexion $instance = null;
    public function __construct(private readonly string $serverName)
    {
        $configuration = parse_ini_file(INI_FILE_PATH, true);
        if (isset($configuration[$serverName])) {
            $configuration = $configuration[$serverName];
            $this->PDO = new PDO($configuration['type'] . ':host='.
                $configuration['IP_adress'] .';dbname='. DATABASES,
                $configuration['user'], $configuration['password']);
            $this->PDO->exec('SET CHARACTER SET utf8');
            $this->PDO->setAttribute(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);
        } else {
            throw new Exception("Server '$serverName' not found in config file");
        }
        unset ($configuration);
    }
    public static function getInstance(string $serverName = 'serveur_admin'): Connexion
    {
        if (is_null(self::$instance)
            || self::$instance->serverName !== $serverName) {
            self::$instance = new Connexion($serverName);
        }
        return self::$instance;
    }
    public function query($query)
    {
        return $this->PDO->query($query);
    }
    public function prepare($query)
    {
        return $this->PDO->prepare($query);
    }
    public function __toString(): string
    {
        return "Connexion is ok";
    }
}
