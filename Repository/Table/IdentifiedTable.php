<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  REQUESTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Requests trait. Used by any Tables that has those properties.
/// Used to factorize common methods and attributes for a more minimalist code.

namespace Framework\Database\Table;

use Framework\database\Connexion;
use Framework\database\Record;
use PDO;

trait IdentifiedTable
{
    public function select(int $ID = null) : Record|bool
    {
        $request = 'SELECT * FROM ' . self::TABLE;
        if (isset($ID))
        {
            $request .= "WHERE ID = $ID ";
        }
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
}