<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////// RECORD ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Contains any return data from a SQL request.
/// A new object will be instanced each time a request is done.

namespace Framework\database;

use Framework\entities\Entity;

class Record
{
    private array $data;
    public function __construct(Entity ...$data) {
        foreach ($data as $datum) {
            $this->addDatum($datum);
        }
    }
    public function getData() : array {
        return $this->data;
    }
    public function setData(array $data) : Record {
        $this->data = $data;
        return $this;
    }
    public function addData(Entity ...$data) : Record {
        foreach ($data as $datum) {
            $this->addDatum($datum);
        }
        return $this;
    }
    public function addDatum(Entity|null $datum, int|null $index = null) : Record {
        if (empty($datum)) {
            return $this;
        }
        if (isset($index)) {
            $this->data[$index] = $datum;
        } else {
            $this->data[] = $datum;
        }
        return $this;
    }
    public function reset() : Record {
        $this->data = array();
        return $this;
    }
}