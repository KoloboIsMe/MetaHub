<?php

namespace services;

interface CategoryInterface
{
    public function existsCategory($CategoryID);

    public function getCategoriesID();

    public function getCategoryById($id);
    public function getCategoryIdByLabel($label);
    public function get5LastCategories();
    public function createCategory($label, $description);

}
