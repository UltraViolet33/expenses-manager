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
}
