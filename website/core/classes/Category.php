<?php
require_once __DIR__ . "/../helpers/Helper.php";
require_once __DIR__ . "/../connection/Database.php";
require_once __DIR__ . "/../connection/Session.php";

class Categorys
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getAll()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->read($sql);
    }

    public function addCategory($data)
    {
        $sql = "INSERT INTO categories(name) VALUES(:name)";
        return $this->db->write($sql, $data);
    }
}
