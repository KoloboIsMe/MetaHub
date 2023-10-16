<?php

namespace Framework\Entity;

class Category
{
    private $ID;
    private $label;
    private $description;

    public function __construct($ID, $label, $description)
    {
        $this->ID = $ID;
        $this->label = $label;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

}