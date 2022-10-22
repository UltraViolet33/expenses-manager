<?php

require_once __DIR__ . '/../connection/config.php';

class Database

{
    private string $host = HOST;
    private string $username = USERNAME;
    private string $password = PASSWORD;
    private string $dbname = DBNAME;

    private ?PDO $pdoInstance;


    public function getConnection()
    {
        $string = "mysql:host=" . HOST . ";dbname=" . DBNAME;
        $this->pdoInstance =  new PDO($string, USERNAME, PASSWORD);
    }


    public function readOneRow($query, array $data = [])
    {
        $this->getConnection();

        $statement = $this->pdoInstance->prepare($query);
        $result = $statement->execute($data);

        if ($result) {
            $data = $statement->fetch(PDO::FETCH_OBJ);
            return $data;
        }

        $this->closeConnection();

        return false;
    }


    public function read($query, array $data = [])
    {
        $this->getConnection();

        $statement = $this->pdoInstance->prepare($query);
        $result = $statement->execute($data);

        if ($result) {
            $data = $statement->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                return $data;
            }
        }

        $this->closeConnection();
        return false;
    }

    public function write($query, $data = array())
    {
        $this->getConnection();
        $statement = $this->pdoInstance->prepare($query);
        $result = $statement->execute($data);

        if ($result) {
            return true;
        }
        return false;
    }

    public function closeConnection()
    {
        $this->pdoInstance = null;
    }
}
