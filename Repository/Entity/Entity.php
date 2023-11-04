<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////  ENTITY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Abstract class to represent an entity (an entry in the database),
///  extended by any of them.
/// TODO : Apply parameters verification to methods.
namespace Framework\Database\Entity;
use Exception;

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
    public function toArray() : array
    {
        return get_class_vars(get_class($this));
    }
}