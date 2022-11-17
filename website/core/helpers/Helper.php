<?php

require_once __DIR__ . "/../connection/Database.php";

class Helper
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function alertMessage($messageType, $head, $body)
    {
        return '
        <div class="alert alert-' . $messageType . ' alert-dismissible fade show" role="alert">
            <strong>' . $head . '</strong> ' . $body . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

    public function getMonthDB()
    {
        $sql = "SELECT actual_month FROM data_website LIMIT 1";
        return $this->db->readOneRow($sql);
    }

    public function updateMonth($data)
    {
        $sql = "UPDATE data_website SET actual_month = :actual_month WHERE actual_month = :old_month";
        return $this->db->write($sql, $data);
    }
}
