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
    public function update(int|Entity $id, Entity $entity) : bool
    {
        $id = is_int($id) ? $id : $id->getID();
        $request = 'UPDATE ' . self::TABLE;
        foreach ($entity->toArray() as $key => $attribute)
        {
            $request .= "SET $key = $attribute";
        }
        $request .= " WHERE 'id' = '$id'";
        if ($this->execute($request) === FALSE)
        {
            return FALSE;
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