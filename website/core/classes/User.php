<?php

require_once __DIR__ . "/../helpers/Helper.php";
require_once __DIR__ . "/../connection/Database.php";
require_once __DIR__ . "/../connection/Session.php";



class User
{

    private $helper;
    private $db;

    public function __construct()
    {
        $this->helper = new Helper();
        $this->db = new Database();
    }


    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            return $this->helper->alertMessage('danger', 'Empty field', 'Please fill all fields');
        }


        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            return $this->class_helper->alertMessage('danger', 'Email error !', 'Email format is not supported');
        }


        $password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $data['email'] = $email;
        $data['password'] = $password;

        $result = $this->db->readOneRow($sql, $data);


        if ($result) {
            Session::set('userId', $result->id_user);
            Session::set('username', $result->name);
            header("Location: Home.php");
            return;
        }

        return $this->helper->alertMessage('danger', 'wrong credential', "wrong email or password");
    }
}
