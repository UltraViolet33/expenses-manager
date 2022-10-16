<?php
require_once __DIR__ . "/../helpers/Helper.php";
require_once __DIR__ . "/../connection/Database.php";
require_once __DIR__ . "/../connection/Session.php";

class Category
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
}
