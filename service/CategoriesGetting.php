<?php

namespace service;

class CategoriesGetting
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }
    public function existsCategory($dataccess, $CategoryID)
    {
        return $dataccess->existsCategory($CategoryID);
    }

    public function getCategories($dataccess)
    {
        $categories = [];
        foreach ($dataccess->getCategoriesID() as $categoryId) {
            $categories[] = $dataccess->getCategoryById($categoryId);
        }
        $this->outputData->setOutputData($categories);
    }

    public function getCategoryById($dataccess, $categoryId)
    {
        return $dataccess->getCategoryById($categoryId);
    }

    public function getPostsIdByCategoryId($dataccess, $id)
    {
        return $dataccess->getPostsIdByCategoryId($id);
    }

    public function add5LastCategories($dataccess)
    {
        $categories = $dataccess->get5LastCategories();
        $this->outputData->addOutputData($categories);
    }
    public function createCategory($dataccess, $label, $description)
    {
        return $dataccess->createCategory($label, $description);
    }
}