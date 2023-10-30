<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  CATEGORY  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single category.

use Framework\Database\Entity\Identified;

class Category extends Entity
{
    use Identified;
    public function __construct(int $ID, private string $label = 'null', private string $description = 'null')
    {
        parent::__construct([$this->ID, $this->label, $this->description]);
    }
    public function setLabel(string $label) : Category
    {
        $this->label = $label;
        return $this;
    }
    public function setDescription(string $description) : Category{
        $this->description = $description;
        return $this;
    }
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