<?php

require_once __DIR__ . "/../models/Category.php";


class CategoryController
{

    private Category $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }


    public function getExpensesByCategory(int $idCategory): array
    {
        return (new Expense())->getExpensesByCategory($idCategory);
    }


    public function getAll(): array
    {
        return $this->categoryModel->selectAll();
    }

    public function add(string $name): bool
    {
        $checkIfExists = $this->categoryModel->selectByName($name);
        if (!$checkIfExists) {
            return $this->categoryModel->create($name);
        }

        return false;
    }


    public function addFromForm(): bool
    {
        if (!isset($_POST["category_name"]) || empty($_POST["category_name"])) {
            Session::set("error", "missing name !");
            return false;
        }

        if ($this->add($_POST["category_name"])) {
            header("Location: /categories/allCategories.php");
            return true;
        }

        Session::set("error", "Name already exists !");

        return false;
    }


    public function getSingle(int $id): object
    {
        return $this->categoryModel->selectById($id);
    }


    public function edit(): bool
    {
        if (!isset($_POST["category_name"]) || empty($_POST["category_name"])) {
            Session::set("error", "missing name !");
            return false;
        }

        $data = ["id" => $_POST["category_id"], "name" => $_POST["category_name"]];

        if ($this->categoryModel->update($data)) {
            header("Location: /categories/allCategories.php");
            return true;
        }

        return false;
    }


    public function delete(int $id): bool
    {
        return $this->categoryModel->delete($id);
    }


    public function addFromAjax(array $data): bool
    {
        return $this->add($data["name"]);
    }
}
