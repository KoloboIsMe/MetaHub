<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////  CATEGORY TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Category' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

use Category;

class CategoryTable
{
    use BasicTable;
    use IdentifiedTable;
    const TABLE = CATEGORY_TABLE;
    private function newEntity(array $data) : Category
    {
        $ID = $data[0];
        $label = $data[1];
        $description = $data[2];
        return new Category($ID, $label, $description);
    }
}