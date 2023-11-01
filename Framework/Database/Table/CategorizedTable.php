<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////  CATEGORIZED TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Categorized' table singleton.
/// TODO : Apply parameters verification to methods.
/// TODO : Create static filtering functions for the select records
namespace Framework\Database\Table;

use Categorized;
use Framework\database\Record;

class CategorizedTable
{
    const TABLE = 'Categorized';
    private function newEntity(array $data) : Categorized
    {
        $ticket = $data[0];
        $category = $data[1];
        return new Categorized($ticket, $category);
    }
    public function select(int $ID = null): Record|null
    {
        return parent::select($ID);
    }
}