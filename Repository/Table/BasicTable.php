<?php

namespace Framework\Database\Table;

use Framework\database\Connexion;
use Framework\database\Record;
use PDO;

trait BasicTable
{
    private string $limit = '100';
    public function __construct(private readonly Connexion $connexion)
    {

    }
    public function find(mixed $entry, string $column) : bool
    {
        $request = "SELECT $column FROM " .  self::TABLE . " WHERE '$entry' = $column ";
        if (($response = $this->execute($request)) === FALSE)
        {
            return FALSE;
        }
        if(empty($response->getData()[0]) === FALSE)
        {
            return $response->getData()[0];
        }
        return FALSE;
    }
    public function select(int $ID = null, string $attribute = null) : Record|bool
    {
        $request = 'SELECT * FROM' . ' ' . self::TABLE;
        // Cas : Recherche par identifiant
        if (isset($ID))
        {
            $request .= " WHERE 'id' = $ID";
        }
        // Cas : Recherche sur une colonne spécifique
        elseif (isset($attribute))
        {
            $request .= " WHERE '$attribute' = $ID";
        }
        return $this->execute($request);
    }
    public function exists(mixed $entry, string $column) : bool
    {
        $request = "SELECT $column FROM " .  self::TABLE . " WHERE '$entry' = $column ";
        if (($response = $this->execute($request)) === FALSE)
        {
            return FALSE;
        }
        if(empty($response->getData()[0]) === FALSE)
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
    public function insert(Entity ...$entities) : bool
    {
        foreach($entities as $entity)
        {
            $part1 = 'INSERT INTO ' . self::TABLE . '(';
            $part2 = ') VALUES (';
            foreach ($entity->toArray() as $attribute => $value)
            {
                $part1 .= $attribute;
                $part2 .= $value;
            }
            $request = $part1 . $part2 . ')';
            if ($this->execute($request) === FALSE)
            {
                return FALSE;
            }
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