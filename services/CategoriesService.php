<?php

namespace services;

class CategoriesService
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function existsCategory($categoriesAccess, $CategoryID)
    {
        return $categoriesAccess->existsCategory($CategoryID);
    }

    public function createCategory($categoriesAccess, $label, $description)
    {
        return $categoriesAccess->createCategory($label, $description);
    }

    public function getCategories($categoriesAccess)
    {
        $categories = [];
        foreach ($categoriesAccess->getCategoriesID() as $categoryId) {
            $categories[] = $categoriesAccess->getCategoryById($categoryId);
        }
        $this->outputData->setOutputData($categories);
    }

    public function getCategoryById($categoriesAccess, $categoryId)
    {
        return $categoriesAccess->getCategoryById($categoryId);
    }

    public function getCategoryIdByLabel($categoriesAccess, $category){
        return $categoriesAccess->getCategoryIdByLabel($category);
    }

    public function add5LastCategories($categoriesAccess)
    {
        $categories = $categoriesAccess->get5LastCategories();
        $this->outputData->addOutputData($categories);
    }
}