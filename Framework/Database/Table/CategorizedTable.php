<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////  CATEGORIZED TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Categorized' table singleton.
/// TODO : Apply parameters verification to methods.
/// TODO : Create static filtering functions for the select records
namespace Framework\Database\Table;

use Categorized;
use Framework\database\Record;

class CategorizedTable
{
    const TABLE = 'Categorized';
    private string $limit = '100';
    public function __construct(protected readonly Connexion $connexion)
    {

    }
    private function newEntity(array $data) : Categorized
    {
        $ticket = $data[0];
        $category = $data[1];
        return new Categorized($ticket, $category);
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
    public function select(int $ticket = null, int $category = null) : Record|null
    {
        $request = 'SELECT * FROM' . self::TABLE;
        if (isset($ticket) && isset($category))
        {
            $request .= "WHERE ticket = $ticket AND category = $category";
        }
        elseif (isset($ticket))
        {
            $request .= "WHERE ID = $ticket";
        }
        elseif (isset($category))
        {
            $request .= "WHERE ID = $category";
        }
        $request .= "LIMIT $this->limit";
        return $this->execute($request);
    }
    public function insert(Categorized ...$entities) : bool
    {
        foreach($entities as $entity)
        {
            $request = 'INSERT INTO' . self::TABLE . 'VALUES (';
            foreach ($entity->toArray() as $value)
            {
                $request .= $value;
            }
            $request .= ')';
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