<?php

namespace service;

class CategoriesGetting
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getCategories($dataccess)
    {
        $tickets = $dataccess->getCategories();
        $this->outputData->setOutputDataCategories($tickets);
    }

    public function getCategoryById($dataccess, $id)
    {
        $tickets = $dataccess->getcategoryById($id);
        $this->outputData->setOutputDataCategories($tickets);
    }

    public function addCategoriesWithTicket($dataccess, $TicketId)
    {
        $categories = $dataccess->getCategoriesWithTicket($TicketId);
        $this->outputData->addOutputDataCategories($categories, $TicketId);
    }

    public function resetOutputDataCategories()
    {
        $this->outputData->resetOutputDataCategories();
    }
}