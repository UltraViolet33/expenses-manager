<?php

class Category
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function selectAll(): array
    {
        $sql = "SELECT * FROM categories";
        return $this->db->read($sql);
    }


    public function selectById(int $id): object
    {
        $sql = "SELECT * FROM categories WHERE id_category = :id";
        return $this->db->readOneRow($sql, ["id" => $id]);
    }


    public function create(string $name): bool
    {
        $sql = "INSERT INTO categories(name) VALUES(:name)";
        return $this->db->write($sql, ["name" => $name]);
    }


    public function update(array $data): bool
    {
        $sql = "UPDATE categories SET name = :name WHERE id_category = :id";
        return $this->db->write($sql, $data);
    }

    
    public function delete(int $id): bool 
    {
        $sql = "DELETE FROM categories WHERE id_category = :id";
        return $this->db->write($sql, ["id" => $id]);
    }
}
