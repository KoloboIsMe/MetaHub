<?php

namespace entities;

include_once 'Entity.php';

class Category extends Entity
{
    private $category_ID;
    private $label;
    private $description;

    //Setters

    public function getCategory_ID()
    {
        return $this->category_ID;
    }

    public function setCategory_ID($category_ID)
    {
        $category_ID = (int)$category_ID;
        if ($category_ID > 0) {
            $this->category_ID = $category_ID;
        }
    }

    public function getLabel()
    {
        return $this->label;
    }

    //Getters

    public function setLabel($label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->description = $description;
        }
    }
}