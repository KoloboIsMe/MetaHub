<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////  CATEGORIZED TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Categorized' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

use Categorized;

class CategorizedTable extends Database implements Table
{
    use IdentifiedTable;
    const TABLE = 'Categorized';
    private function newEntity(array $data) : Categorized
    {
        $ticket = $data[0];
        $category = $data[1];
        return new Categorized($ticket, $category);
    }
}