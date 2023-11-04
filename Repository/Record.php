<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////// RECORD ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Contains any return data from a SQL request (A list of entities)
/// A new object will be instanced each time a request is done.

namespace Framework\database;

use Framework\Database\Entity\Entity;

class Record
{
    private array $data;
    public function __construct(Entity ...$data) {
        foreach ($data as $datum) {
            $this->addDatum($datum);
        }
    }
    public function getData() : array {
        if(isset($this->data))
        {
            return $this->data;
        }
        return [];
    }
    public function addData(Entity ...$data) : Record {
        foreach ($data as $datum) {
            $this->addDatum($datum);
        }
        return $this;
    }
    public function addDatum(Entity $datum, int|null $index = null) : Record {
        if (isset($index)) {
            $this->data[$index] = $datum;
        } else {
            $this->data[] = $datum;
        }
        return $this;
    }
}