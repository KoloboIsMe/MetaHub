<?php

namespace Framework\Database\Table;

use Framework\database\Record;

trait IdentifiedTable
{
    public function select(int $ID = null) : Record|null
    {
        $request = 'SELECT * FROM' . self::TABLE;
        if (isset($ID))
        {
            $request .= "WHERE ID = $ID";
        }
        $request .= "LIMIT $this->limit";
        $query = $this->connexion->prepare($request);
        if(!$query->execute())
        {
            echo "erreur requete (exception)";
            return null;
        }
        $record = new Record();
        while($datum = $query->fetch(PDO::FETCH_ASSOC))
        {
            $record->addDatum($this->newEntity($datum));
        }
        return $record;
    }
}