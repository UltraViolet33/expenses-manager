<?php

require_once __DIR__ . "/../models/Category.php";


class CategoryController
{

    private Category $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }


    public function getAll(): array
    {
        return $this->categoryModel->selectAll();
    }
    

    public function add(): bool
    {
        if (!isset($_POST["category_name"]) || empty($_POST["category_name"])) {
            Session::set("error", "missing name !");
            echo "o";
            return false;
        }

        if ($this->categoryModel->create($_POST["category_name"])) {
            header("Location: /categories/allCategories.php");
            return true;
        }

        return false;
    }
}
