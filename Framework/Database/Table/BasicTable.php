<?php

namespace Framework\Database\Table;

use Framework\database\Connexion;
use Framework\database\Record;

trait BasicTable
{
    private string $limit = '100';
    public function __construct(private readonly Connexion $connexion)
    {

    }
    public function exists(mixed $entry, string $column) : bool
    {
        $request = "SELECT $column FROM" .  self::TABLE . "where $entry = :username ";
        if ($response = $this->execute($request) === FALSE)
        {
            return TRUE;
        }
        $response = $response->fetch(PDO::FETCH_ASSOC);
        if(empty($response) === FALSE)
        {
            return TRUE;
        }
        return FALSE;
    }
    public function execute(string $request) : Record|bool
    {
        $request .= " LIMIT $this->limit;";
        $query = $this->connexion->prepare($request);
        if(!$query->execute())
        {
            return FALSE;
        }
        if(preg_match('/SELECT/', $request) !== FALSE) {
            $record = new Record();
            while(!empty($datum = $query->fetch(PDO::FETCH_ASSOC)))
            {
                $record->addDatum($this->newEntity($datum));
            }
            return $record;
        }
        return TRUE;
    }
    public function getLimit(): string
    {
        return $this->limit;
    }

    public function setLimit(string $limit)
    {
        $this->limit = $limit;
        return $this;
    }
}