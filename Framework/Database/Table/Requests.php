<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  REQUESTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Requests trait. Used by any Tables that has those properties.
/// Used to factorize common methods and attributes for a more minimalist code.

namespace Framework\Database\Table;

use Framework\database\Connexion;
use Framework\database\Record;

trait Requests
{
    private string $limit = '100';
    public function __construct(private readonly Connexion $connexion)
    {

    }
    public function execute(string $request) : Record|bool
    {
        $request .= "LIMIT $this->limit";
        $query = $this->connexion->prepare($request);
        if(!$query->execute())
        {
            return FALSE;
        }
        if(preg_match('SELECT', $request)) {
            $record = new Record();
            while($datum = $query->fetch(PDO::FETCH_ASSOC))
            {
                $record->addDatum($this->newEntity($datum));
            }
            return $record;
        }
        return TRUE;
    }
    public function select(int $ID = null) : Record|bool
    {
        $request = 'SELECT * FROM' . self::TABLE;
        if (isset($ID))
        {
            $request .= "WHERE ID = $ID";
        }
        $request .= "LIMIT $this->limit";
        return $this->execute($request);
    }
    public function insert(Entity ...$entities) : bool
    {
        foreach($entities as $entity)
        {
            $part1 = 'INSERT INTO' . self::TABLE . '(';
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
    public function delete(int ...$IDs) : bool
    {
        foreach($IDs as $ID)
        {
            $request = 'DELETE FROM' . self::TABLE . "WHERE ID = $ID";
            if ($this->execute($request) === FALSE)
            {
                return FALSE;
            }
        }
        return TRUE;
    }
    public function exists(mixed $entry, string $column) : bool
    {
        $request = "SELECT $column FROM users where $entry = :username LIMIT $this->limit";
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
    public function getLimit(): string
    {
        return $this->limit;
    }

    public function setLimit(string $limit): Table
    {
        $this->limit = $limit;
        return $this;
    }
}