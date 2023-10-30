<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  CATEGORY  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single category.
/// TO DO : Give default values to constructor

use Framework\Database\Entity\Identified;

class Category extends Entity
{
    use Identified;
    public function __construct(int $ID, private string $label = 'null', private string $description = 'null')
    {
        parent::__construct([$ID]);
    }
    public function setLabel(string $label) : Category
    {
        $this->label = $label;
        return $this;
    }
    public function setDescription(string $description) : Category
    {
        $this->description = $description;
        return $this;
    }
    public function getLabel() : string
    {
        return $this->label;
    }
    public function getDescription() : string
    {
        return $this->description;
    }
}