<?php

namespace Entity;

class Category implements Entity
{
    private $ID;
    private $label;
    private $description;


    public function select(){
        /**
        SELECT ID, LABEL, DESCRIPTION
        FROM CATEGORY
         *
         */
    }
}