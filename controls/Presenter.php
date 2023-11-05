<?php

namespace controls;

use entities\Category;
use entities\Post;

class Presenter
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function show($presenterName)
    {
        $data = $this->outputData->getOutputData();
        extract(array('data' => $data));
        ob_start();
        require 'controls/pagePresenters/' . $presenterName . '.php';
        return ob_get_clean();
    }

    public function showCategory($category)
    {
        $data = $this->outputData->getOutputData();
        extract(array('data' => $data, 'category' => $category));
        ob_start();
        require 'controls/pagePresenters/category.php';
        return ob_get_clean();
    }

    public function showUser($user)
    {
        $data = $this->outputData->getOutputData();
        extract(array('data' => $data, 'user' => $user));
        ob_start();
        require 'controls/pagePresenters/user.php';
        return ob_get_clean();
    }

}