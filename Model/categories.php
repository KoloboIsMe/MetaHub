<?php
global $categorizedTable, $categoryTable;

if(!isset($ticketID))
{
    return;
}

$categorizations = $categorizedTable->select($ticketID);

foreach ($categorizations->getData() as $categorization)
{
    $categories = $categoryTable->select($categorization->getCategory());
}
