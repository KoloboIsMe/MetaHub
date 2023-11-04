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
    use BasicTable;
    const TABLE = 'categorized';
    private function newEntity(array $data) : Categorized
    {
        $ticket = $data[0];
        $category = $data[1];
        return new Categorized($ticket, $category);
    }
    public function categoriesOf(int $ticket) : array|bool
    {
        if(($record = $this->select($ticket)) === FALSE)
        {
            return FALSE;
        }
        foreach ($record->getData() as $ticket) {
            $categories[] = $ticket->category();
        }
        return $categories;
    }
    public function ticketsOf(int $category) : array|bool
    {
        if(($record = $this->select($category)) === FALSE)
        {
            return FALSE;
        }
        foreach ($record->getData() as $ticket) {
            $tickets[] = $ticket->ticket();
        }
        return $tickets;
    }
    public function select(int $ticket = null, int $category = null) : Record|bool
    {
        $request = 'SELECT * FROM ' . self::TABLE;
        if (isset($ticket) && isset($category))
        {
            $request .= " WHERE ticket = $ticket AND category = $category";
        }
        elseif (isset($ticket))
        {
            $request .= " WHERE ticket = $ticket";
        }
        elseif (isset($category))
        {
            $request .= " WHERE category = $category";
        }
        echo $request;
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
    public function delete(string $key, int ...$IDs) : bool
    {
        if ($key !== 'ticket' && $key !== 'category')
        {
            return FALSE;
        }
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
}