<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  IDENTIFIED  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Identified trait. Shared by entities which have an ID as a primary key.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Entity;
trait ID
{
    private int $ID;
    public function setID(int $ID) : Entity
    {
        if ($ID > 0) {
            $this->ID = $ID;
        } else {
            throw new Exception('ID cannot be unde zero');
        }
        return $this;
    }

    public function getID() : int
    {
        return $this->ID;
    }
}