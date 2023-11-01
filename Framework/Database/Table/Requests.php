<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  REQUESTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Requests trait. Used by any Tables that has those properties.
/// Used to factorize common methods and attributes for a more minimalist code.

namespace Framework\Database\Table;

use Framework\database\Record;

trait Requests
{
    private string $limit = '100';
    public function __construct(protected readonly Connexion $connexion)
    {

    }
    public function execute(string $request) : Record|bool
    {
        $request .= "LIMIT $this->limit";
        $query = $this->connexion->prepare($request);
        if(!$query->execute())
        {
            return false;
        }
        if(true) {
            $record = new Record();
            while($datum = $query->fetch(PDO::FETCH_ASSOC))
            {
                $record->addDatum($this->newEntity($datum));
            }
            return $record;
        }
        return true;
    }
    public function select(int $ID = null) : Record|null
    {
        $request = 'SELECT * FROM' . self::TABLE;
        if (isset($ID))
        {
            $request .= "WHERE ID = $ID";
        }
        $request .= "LIMIT $this->limit";
        return $this->execute($request);
    }
    public function insert(Entity ...$entities) : boolean
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
    public function delete(int ...$IDs) : boolean
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