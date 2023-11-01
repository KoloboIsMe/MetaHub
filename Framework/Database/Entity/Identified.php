<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  IDENTIFIED  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Identified trait. Used in objects which have an ID as a primary key.

trait Identified
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