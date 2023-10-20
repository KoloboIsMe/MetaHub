<?php

namespace entities;
include_once 'entities/Entity.php';
class Category extends Entity
{
    public function __construct($data)
    {
        $this->hydrate($data);
    }

    //Hydratation
    public function hydrate($data)
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