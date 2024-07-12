<?php

require_once __DIR__ . "/../models/Recurence.php";


class RecurenceController
{
    private Recurence $recurenceModel;

    public function __construct()
    {
        $this->recurenceModel = new Recurence();
    }


    public function getAll(): array
    {
        return $this->recurenceModel->selectAll();
    }
}
