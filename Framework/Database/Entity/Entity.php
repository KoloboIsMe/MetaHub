<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////  ENTITY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Abstract class to represent an entity (an entry in the database),
///  extended by any of them.
/// All objects has an ID wich is its primary key.

abstract class Entity
{
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    private function hydrate($data)
    {
        foreach($data as $attribute => $datum)
        {
            $method = 'set'.ucfirst($attribute);
            if(method_exists($this,$method))
            {
                $this->$method($datum);
            }
            else
            {
                throw new Exception('Hydratation failed');
            }
        }
    }
}