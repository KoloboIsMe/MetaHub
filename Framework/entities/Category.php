<?php

namespace entities;

include_once 'Entity.php';

class Category extends Entity
{
    /**
     * @var
     */
    private $category_ID;
    /**
     * @var
     */
    private $label;
    /**
     * @var
     */
    private $description;

    /**
     * @return int
     */
    public function getCategory_ID()
    {
        return $this->category_ID;
    }

    /**
     * @param $category_ID
     * @return void
     */
    public function setCategory_ID($category_ID)
    {
        $category_ID = (int)$category_ID;
        if ($category_ID > 0) {
            $this->category_ID = $category_ID;
        }
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param $label
     * @return void
     */
    public function setLabel($label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return void
     */
    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->description = $description;
        }
    }
}