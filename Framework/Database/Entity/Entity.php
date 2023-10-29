<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////  ENTITY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Abstract class to represent an entity (an entry in the database),
///  extended by any of them.

namespace Framework\entities;

abstract class Entity
{
    //Constructeur
    public function __construct(array $data){
        $this->hydrate($data);
    }
    //Hydratation
    private function hydrate($data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this,$method))
            {
                $this->$method($value);
            }
        }
    }
}