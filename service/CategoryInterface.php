<?php

namespace service;

interface CategoryInterface
{
    public function getCategoriesID();

    public function getCategoryById($id);

    public function getPostsIdByCategoryId($id);

}
