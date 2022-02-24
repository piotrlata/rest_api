<?php

namespace app\controller;

use app\config\Router;
use app\model\Product;

class ProductController
{
    public function index(Router $router)
    {
        $search = $_GET['search'] ?? '';
        $products = $router->db->getProducts($search);
        $router->renderView("products/index", [
            'products' => $products,
            'search' => $search
        ]);
    }

    public function create(Router $router)
    {
        $errors = [];
        $productData = [
            'title' => '',
            'description' => '',
            'image' => '',
            'price' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['image'] = $_POST['image'] ?? null;
            $productData['price'] = (float)$_POST['price'];

            $product = new Product();
            $product->load($productData);
            $product->save();
        }
        echo '<pre>';
        var_dump($productData);
        echo '</pre>';
        $router->renderView("products/create", [
            'product' => $productData,
            'errors' => $errors
        ]);
    }

    public function update()
    {
        echo "update page";
    }

    public function delete()
    {
        echo "delete page";
    }
}