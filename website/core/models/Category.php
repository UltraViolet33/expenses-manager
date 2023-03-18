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

    
    public function create(string $name): bool
    {
        $sql = "INSERT INTO categories(name) VALUES(:name)";
        return $this->db->write($sql, ["name" => $name]);
    }
}
