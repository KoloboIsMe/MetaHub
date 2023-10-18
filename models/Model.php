<?php

abstract class Model
{
    const DB_HOST = 'mysql-metahub.alwaysdata.net';
    const DB_PASSWORD = 'MetaHubAdmin13.';
    const DB_USERNAME = 'metahub';
    const DB_NAME = 'metahub_login';
    private static $_bdd;

    // Instancie la connexion à la base de données
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME.';charset=utf8', self::DB_USERNAME, self::DB_PASSWORD);
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Récupère la connexion à la base de données
    protected function getBdd()
    {
        if(self::$_bdd == null)
            self::setBdd();
        return self::$_bdd;
    }

    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' LIMIT 100');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
    }
}