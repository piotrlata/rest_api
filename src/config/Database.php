<?php

namespace app\config;

use app\model\Product;
use PDO;

class Database
{
    private PDO $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=test", 'root', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getProducts($search = '')
    {
        if ($search) {
            $statement = $this->pdo->prepare('SELECT * FROM test.product WHERE title like :keyword ORDER BY create_date DESC');
            $statement->bindValue(":keyword", "%$search%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM test.product ORDER BY create_date DESC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createProduct(Product $product) {

    }
}