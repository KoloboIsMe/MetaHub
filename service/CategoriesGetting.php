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

    public function get5LastPosts($dataccess)
    {
        $posts = [];
        foreach ($dataccess->get5LastPostID() as $ticketId) {
            $posts[] = $dataccess->getCategoryById($ticketId);
        }
        $this->outputData->setOutputData($posts);
    }
}