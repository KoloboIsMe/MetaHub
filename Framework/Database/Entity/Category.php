<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  CATEGORY  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single category.
/// TO DO : Create a constructor as in the Comment class

namespace Framework\entities;

include_once 'entities/Entity.php';
class Category extends Entity
{
    private $category_ID;
    private $label;
    private $description;

    //Setters
    public function setCategory_ID($category_ID){
        $category_ID = (int) $category_ID;
        if($category_ID > 0){
            $this->category_ID = $category_ID;
        }
    }
    public function setLabel($label){
        if(is_string($label)){
            $this->label = $label;
        }
    }
    public function setDescription($description){
        if(is_string($description)){
            $this->description = $description;
        }
    }

    //Getters
    public function getCategory_ID()
    {
        return $this->category_ID;
    }
    public function getLabel()
    {
        return $this->label;
    }
    public function getDescription()
    {
        return $this->description;
    }
}