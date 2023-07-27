<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";

class ProductRepository
{
    private DatabaseConnector $databaseConnector;
    public function __construct(DatabaseConnector $databaseConnector)
    {
        // выяснить доступ по ссылке на объект или копируется из констракта
        $this->databaseConnector = $databaseConnector;
    }

//    public $connect;
    public function findAll()
    {
//        echo " findUsersListThreeFields ";
        $result = mysqli_fetch_all($this->databaseConnector->connect->query(
            "SELECT * FROM products"
        ), MYSQLI_ASSOC);
        return $result;
    }
}