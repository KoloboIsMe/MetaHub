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
    private string $label;
    private string $description;

    public function __construct(int $ID, string $label = 'null', string $description = 'null')
    {
        parent::__construct([$ID, $label, $description]);
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