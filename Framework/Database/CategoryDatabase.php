<?php
namespace Framework\Database;

use Framework\Entity\Category;
use PDO;
class CategoryDatabase
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = dataBaseConnexion::getInstance()->getPDO();
    }
    public function selectCategory($attribute, $data): ?array
    {
        $statement = $this->PDO->prepare("SELECT * FROM category WHERE $attribute = :data LIMIT 100");
        if(!($statement->execute([
            'data' => $data
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
        $categories = [];
        $cpt = 0;
        while ($category = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new Category($category->ID, $category->label, $category->description);
            $categories[$cpt] = $post;
            $cpt++;
        }
        return $categories;
    }

    public function insert($category)
    {
        $statement = $this->PDO->prepare(
            "INSERT INTO category (label, description) VALUES (:label, :description)");
        if(!($statement->execute([
            ':label' => $category->getLabel(),
            ':description' => $category->getDescription()
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
    }

}