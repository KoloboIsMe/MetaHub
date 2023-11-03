<?php

namespace database;


use entities\Category;
use PDO;
use PDOException;
use service\CategoryInterface;


include_once "service/CategoryInterface.php";
include_once "Framework/entities/Category.php";

class CategoryAccess implements CategoryInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

    public function getCategoriesID(){
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT category_ID FROM category ORDER BY category_ID DESC LIMIT 100');
            $statement->execute();
            while($data = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $ID[] = $data['category_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getCategoryById($ID)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM category where category_ID = :ID');
            $statement->execute([':ID' => $ID ]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return new Category($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public function getPostsIdByCategoryId($id){
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT ticket FROM categorized where category = :ID ORDER BY ticket DESC LIMIT 100');
            $statement->execute([':ID' => $id ]);
            while($data = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $ID[] = $data['ticket'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}