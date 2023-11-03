<?php

namespace entities;

abstract class Entity
{
    //Constructeur
    public function __construct(array $data){
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