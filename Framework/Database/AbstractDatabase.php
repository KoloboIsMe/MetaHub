<?php

namespace Database;
use Entity\User;
abstract class AbstractDatabase
{
    private $tableName;
    protected $PDO;
    public function __construct($tableName)
    {
        $this->PDO = (new dataBaseConnexion())->getPDO();
        $this->tableName = $tableName;
    }
}