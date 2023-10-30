<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  IDENTIFIED  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Identified trait. Used in objects which have an ID as a primary key.

trait Identified
{
    protected int $ID;

    public function set_ID(int $ID) : Entity
    {
        if ($ID > 0) {
            $this->ID = $ID;
        } else {
            throw new Exception('ID cannot be unde zero');
        }
        return $this;
    }

    public function get_ID() : int
    {
        return $this->ID;
    }
}