<?php

require_once __DIR__ . "/../connection/Database.php";


class Recurence
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function selectAll(): array
    {
        $sql = "SELECT * FROM recurences";
        return $this->db->read($sql);
    }
}
