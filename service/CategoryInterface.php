<?php

namespace service;

interface CategoryInterface
{
    public function existsCategory($CategoryID);
    public function getCategoriesID();

    public function getCategoryById($id);

    public function getPostsIdByCategoryId($id);

}
