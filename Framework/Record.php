<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////// RECORD ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Contains any return data from a SQL request.
/// A new object will be instanced each time a request is done.
///
namespace Framework;

use Framework\entities\Entity;

class Record
{
    public function __construct(private array $data) {

    }
    public function getData() : Entity {
        return $this->data;
    }
    public function setData(array $data) : array{
        $this->data = $data;
        return $this;
    }
    public function addData(Entity ...$data) : Record {
        foreach ($data as $datum) {
            $this->data[] = $datum;
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
    public function reset() : Record {
        $this->data = array();
        return $this;
    }
}