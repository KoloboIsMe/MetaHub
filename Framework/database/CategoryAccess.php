<?php

namespace database;


use entities\Category;
use PDO;
use PDOException;
use services\CategoryInterface;


include_once "services/CategoryInterface.php";
include_once "Framework/entities/Category.php";

class CategoryAccess implements CategoryInterface
{
    /**
     * @var null
     */
    protected $dataAccess = null;

    /**
     * @param $dataAccess
     */
    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * @param $CategoryID
     * @return bool
     */
    public function existsCategory($CategoryID): bool
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM category where category_ID = :CategoryID');
            $statement->execute(['CategoryID' => $CategoryID]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return isset($data['category_ID']);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $ID
     * @return Category
     */
    public function getCategoryById($ID): Category
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM category where category_ID = :ID');
            $statement->execute([':ID' => $ID]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return new Category($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @return int[]
     */
    public function getCategoriesID(): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT category_ID FROM category ORDER BY category_ID DESC LIMIT 100');
            $statement->execute();
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['category_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @return Category[]
     */
    public function get5LastCategories(): array
    {
        try {
            $categories = [];
            $statement = $this->dataAccess->prepare('SELECT * FROM category ORDER BY category_ID DESC LIMIT 5');
            $statement->execute();
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Category($data);
            }
            return $categories;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $label
     * @return int
     */
    public function getCategoryIdByLabel($label)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT category_ID FROM category where label = :label');
            $statement->execute([
                ':label' => $label,
            ]);
            return $statement->fetch(PDO::FETCH_ASSOC)['category_ID'];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $label
     * @param $description
     * @return string|null
     */
    public function createCategory($label, $description): ?string
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT category_ID FROM category where label = :label');
            $statement->execute([':label' => $label]);

            if (isset($statement->fetch(PDO::FETCH_ASSOC)['category_ID'])) {
                return "Cette catégorie existe déjà";
            }
            $statement = $this->dataAccess->prepare('INSERT INTO category (label, description) VALUES (:label, :description)');
            $statement->execute([':label' => $label, ':description' => $description]);
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


}